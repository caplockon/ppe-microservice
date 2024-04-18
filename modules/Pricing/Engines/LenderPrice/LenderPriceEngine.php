<?php
declare(strict_types=1);

namespace Modules\Pricing\Engines\LenderPrice;

use Illuminate\Support\Facades\Crypt;
use Modules\Client\Models\Client;
use Modules\Libraries\LenderPriceSDK\LenderPriceClient;
use Modules\Libraries\LenderPriceSDK\LenderPriceCredentials;
use Modules\Pricing\Contracts\Engine\PricingEngineInterface;
use Modules\Pricing\Contracts\Engine\PricingExecutorInterface;

class LenderPriceEngine implements PricingEngineInterface
{
    public function getName(): string
    {
        return "Lender Price";
    }

    /**
     * @inheritDoc
     */
    public function createPricingExecutor(Client $client, mixed $credentials): PricingExecutorInterface
    {
        $credentials = $credentials instanceof LenderPriceCredentials
            ? $credentials
            : LenderPriceCredentials::fromArray($credentials);

        $api = new LenderPriceClient([
            LenderPriceCredentials::class => $credentials,
        ]);

        return new LenderPricePricingExecutor($api, $client);
    }

    /**
     * @inheritDoc
     * @see LenderPriceCredentials
     */
    public function getCredentialsValidationRules(): array
    {
        return [
            'base_url' => 'required|url',
            'api_key' => 'required',
            'user_id' => 'required',
            'company_id' => 'required',
        ];
    }

    /**
     * @inheritDoc
     */
    public function decryptCredentials(mixed $credentials): mixed
    {
        if (!empty($credentials['api_key'])) {
            $credentials['api_key'] = Crypt::decrypt($credentials['api_key']);
        }
        return $credentials;
    }

    /**
     * @inheritDoc
     */
    public function encryptCredentials(mixed $credentials): mixed
    {
        if (!empty($credentials['api_key'])) {
            $credentials['api_key'] = Crypt::encrypt($credentials['api_key']);
        }
        return $credentials;
    }
}
