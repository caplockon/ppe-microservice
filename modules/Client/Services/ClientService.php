<?php
declare(strict_types=1);

namespace Modules\Client\Services;

use Modules\Client\Contracts\Repositories\ClientRepositoryInterface;
use Modules\Client\Contracts\Services\ClientServiceInterface;
use Modules\Client\DTO\Inputs\SubscribeClientInput;
use Modules\Client\DTO\Outputs\SubscribeClientOutput;
use Modules\Client\DTO\PricingEngineDTO;
use Modules\Client\Models\Client;
use Modules\Pricing\Models\ClientPricingEngine;

readonly class ClientService implements ClientServiceInterface
{
    public function __construct(
        private ClientRepositoryInterface $clientRepository
    )
    {}

    /**
     * @inheritDoc
     */
    public function subscribeClient(SubscribeClientInput $input): SubscribeClientOutput
    {
        $client = $this->clientRepository->getByUname($input->uname);
        if ($client?->deleted_at) {
            $client->restore();
        }

        $client = $client ?? new Client();
        $client->uname = $input->uname;
        $client->name = $input->name;
        $client->save();

        $this->updatePricingEngineCredentials($client, $input->pricing_engine);

        $output = new SubscribeClientOutput($input);
        $output->client = $client;

        return $output;
    }

    /**
     * @param Client $client
     * @param $pricingEngineDTO $in$pricingEngineDTOput
     * @return void
     */
    protected function updatePricingEngineCredentials(Client $client, PricingEngineDTO $pricingEngineDTO): void
    {
        $credentials = $client->pricingEngine ?? new ClientPricingEngine();
        $credentials->engine_driver = $pricingEngineDTO->engine_driver;
        $credentials->engine_credentials = $pricingEngineDTO->engine_credentials;

        $client->pricingEngine()->save($credentials);
        $client->setRelation('pricingEngine', $credentials);
    }
}
