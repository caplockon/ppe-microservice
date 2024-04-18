<?php
declare(strict_types=1);

namespace Modules\Client\Models\Relations;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Pricing\Models\ClientPricingEngine;

/**
 * @property ClientPricingEngine|null $pricingEngine
 */
trait ClientRelations
{
    /**
     * @return HasOne
     */
    public function pricingEngine(): HasOne
    {
        return $this->hasOne(ClientPricingEngine::class, 'client_id', 'id');
    }
}
