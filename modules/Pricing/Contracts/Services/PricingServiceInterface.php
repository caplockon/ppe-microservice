<?php
declare(strict_types=1);

namespace Modules\Pricing\Contracts\Services;

use Modules\Pricing\Contracts\Engine\PricingEngineInterface;
use Modules\Pricing\DTO\Inputs\PricingSearchInput;
use Modules\Pricing\DTO\Outputs\PricingSearchOutput;

interface PricingServiceInterface
{
    /**
     * Return list of supported engines
     *
     * @return array
     */
    public function getAvailableEngines(): array;

    /**
     * @param string $name
     * @param string|PricingEngineInterface $engine
     * @return mixed
     */
    public function setEngine(string $name, string|PricingEngineInterface $engine);

    /**
     * @param string $name
     * @return PricingEngineInterface
     */
    public function getEngine(string $name): PricingEngineInterface;

    /**
     * @param PricingSearchInput $input
     * @return PricingSearchOutput
     */
    public function search(PricingSearchInput $input): PricingSearchOutput;
}
