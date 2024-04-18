<?php
declare(strict_types=1);

namespace Modules\Pricing\Models\Relations;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Client\Models\Client;

/**
 * @property Client|null $client
 */
trait ClientPricingEngineRelations
{
    /**
     * @return BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }
}
