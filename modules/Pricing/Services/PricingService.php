<?php
declare(strict_types=1);

namespace Modules\Pricing\Services;

use InvalidArgumentException;
use Modules\Client\Contracts\Repositories\ClientRepositoryInterface;
use Modules\Pricing\Contracts\Engine\PricingEngineInterface;
use Modules\Pricing\Contracts\Services\PricingServiceInterface;
use Modules\Pricing\DTO\Inputs\PricingSearchInput;
use Modules\Pricing\DTO\Outputs\PricingSearchOutput;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class PricingService implements PricingServiceInterface
{
    /**
     * @var PricingEngineInterface[]|class-string<PricingEngineInterface>[]
     */
    protected array $engines = [];

    public function __construct(
        protected readonly ClientRepositoryInterface $clientRepository
    )
    {}

    /**
     * @inheritDoc
     */
    public function getAvailableEngines(): array
    {
        return $this->engines;
    }

    /**
     * @inheritDoc
     */
    public function setEngine(string $name, PricingEngineInterface|string $engine)
    {
        $this->engines[$name] = $engine;
    }

    /**
     * @inheritDoc
     */
    public function getEngine(string $name): PricingEngineInterface
    {
        $engine = $this->engines[$name] ?? null;

        if (empty($engine)) {
            throw new InvalidArgumentException("Engine {$engine} is not available");
        }

        return $engine instanceof PricingEngineInterface ? $engine : app($engine);
    }

    /**
     * @param PricingSearchInput $input
     * @return PricingSearchOutput
     */
    public function search(PricingSearchInput $input): PricingSearchOutput
    {
        $client = $this->clientRepository->getByUname($input->client_uname);
        empty($client) && throw new BadRequestHttpException("Client not found for uname $input->client_uname");

        $credentials = $client->pricingEngine;
        empty($credentials) && throw new BadRequestHttpException("Client {$client->uname} does not setup ppe engine");

        $engine = $this->getEngine($credentials->engine_driver);
        $executor = $engine->createPricingExecutor($client, $credentials->engine_credentials);
        return $executor->execute($input);
    }
}
