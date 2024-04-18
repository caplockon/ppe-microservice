<?php
declare(strict_types=1);

namespace Modules\Shared\Models;

use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Models\Model;

/**
 * @property string|null $key
 * @property string|null $value
 */
class Metadata extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'metadata';

    /**
     * @var string[]
     */
    protected $hidden = [
        'id',
        'deleted_at',
        'metadatable_type',
        'metadatable_id',
        'created_at',
        'updated_at',
    ];

    /**
     * @return MorphTo
     */
    public function metadatable(): MorphTo
    {
        return $this->morphTo();
    }
}
