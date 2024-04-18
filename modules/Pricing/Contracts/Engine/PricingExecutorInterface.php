<?php
declare(strict_types=1);

namespace Modules\Pricing\Contracts\Engine;

use Modules\Pricing\DTO\Inputs\PricingSearchInput;
use Modules\Pricing\DTO\Outputs\PricingSearchOutput;

interface PricingExecutorInterface
{
    /**
     * @param PricingSearchInput $input
     * @return PricingSearchOutput
     */
    public function execute(PricingSearchInput $input): PricingSearchOutput;
}
