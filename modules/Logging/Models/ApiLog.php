<?php
declare(strict_types=1);

namespace Modules\Logging\Models;

use Modules\Shared\Concerns\HasMetadata;
use Modules\Core\Models\Model;

/**
 * @property int|null $id
 * @property string|null $uid
 * @property string|null $name
 * @property string|null $method
 * @property string|null $url
 * @property string|null $request_header
 * @property string|null $request_body
 * @property string|null $response_header
 * @property string|null $response_body
 * @property string|null $response_status
 * @property string|null $trace_log
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class ApiLog extends Model
{
    use HasMetadata;

    /**
     * @var string
     */
    protected $table = 'api_logs';

    /**
     * @var string[]
     */
    protected $guarded = [
        'id',
        'uid',
        'created_at',
        'updated_at',
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'id',
    ];
}
