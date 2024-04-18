<?php
declare(strict_types=1);

namespace Modules\Client\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Client\Models\Relations\ClientRelations;
use Modules\Core\Models\Model;

/**
 * @property int|null $id
 * @property string|null $uid
 * @property string|null $uname
 * @property string|null $name
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $deleted_at
 */
class Client extends Model
{
    use SoftDeletes;
    use ClientRelations;

    /**
     * Table to manage clients
     * @var string
     */
    protected $table = 'clients';

    /**
     * @var string[]
     */
    protected $hidden = [
        'id',
        'deleted_at',
    ];

    /**
     * @var string[]
     */
    protected $guarded = [
        'id',
        'uid',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
