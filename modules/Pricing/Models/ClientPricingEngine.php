<?php
declare(strict_types=1);

namespace Modules\Pricing\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Models\Model;
use Modules\Pricing\Models\Casts\CredentialsCast;
use Modules\Pricing\Models\Relations\ClientPricingEngineRelations;

/**
 * @property int|null $id
 * @property string|null $uid
 * @property int|null $client_id
 * @property string|null $engine_driver
 * @property string|null $engine_credentials
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $deleted_at
 */
class ClientPricingEngine extends Model
{
    use SoftDeletes;
    use ClientPricingEngineRelations;

    /**
     * Table name
     * @var string
     */
    protected $table = 'client_pricing_engines';

    /**
     * @var string[]
     */
    protected $hidden = [
        'id',
        'uid',
        'client_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * @var string[]
     */
    protected $guarded = [
        'id',
        'uid',
        'client_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'engine_credentials' => CredentialsCast::class,
    ];
}
