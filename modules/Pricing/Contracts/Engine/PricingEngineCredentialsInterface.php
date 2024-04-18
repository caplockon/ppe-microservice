<?php
declare(strict_types=1);

namespace Modules\Pricing\Contracts\Engine;

interface PricingEngineCredentialsInterface
{
    /**
     * @return array
     */
    public function toArray(): array;
}
