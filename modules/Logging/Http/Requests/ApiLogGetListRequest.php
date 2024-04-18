<?php
declare(strict_types=1);

namespace Modules\Logging\Http\Requests;

use Modules\Core\Http\FormRequest;
use Modules\Logging\Http\RequestCriteria\ApiLogGetListRequestCriteria;

class ApiLogGetListRequest extends FormRequest
{
    /**
     * @var array|string[]
     */
    protected array $criteria = [
        ApiLogGetListRequestCriteria::class,
    ];

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'order_by' => 'nullable|in:id,created_at',
            'order_dir' => 'nullable|in:asc,desc',
            'meta_name' => 'nullable|string|min:1',
            'meta_value' => 'nullable|string',
        ];
    }
}
