<?php
declare(strict_types=1);

namespace Modules\Pricing\Engines\LenderPrice;

use Modules\Client\Models\Client;
use Modules\Libraries\LenderPriceSDK\LenderPriceClient;
use Modules\Pricing\Contracts\Engine\PricingExecutorInterface;
use Modules\Pricing\DTO\Inputs\PricingSearchInput;
use Modules\Pricing\DTO\Outputs\PricingSearchOutput;

class LenderPricePricingExecutor implements PricingExecutorInterface
{
    /**
     * @param LenderPriceClient $api
     * @param Client $client
     */
    public function __construct(
        protected LenderPriceClient $api,
        protected Client $client,
    )
    {}

    /**
     * @inheritDoc
     */
    public function execute(PricingSearchInput $input): PricingSearchOutput
    {
        return new PricingSearchOutput($input);
    }
}
