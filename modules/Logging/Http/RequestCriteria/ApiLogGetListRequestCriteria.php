<?php
declare(strict_types=1);

namespace Modules\Logging\Http\RequestCriteria;

use Modules\Core\Http\RequestCriteria;

class ApiLogGetListRequestCriteria extends RequestCriteria
{
    /**
     * @inheritDoc
     */
    public function apply(mixed $model): mixed
    {
        // TODO: Need to define the following code block in other class
        $model->orderBy(
            $this->request->get('order_by', 'id'),
            $this->request->get('order_dir', 'desc'),
        );

        $metaName = $this->request->get('meta_name');
        $metaValue = $this->request->get('meta_value');
        if ($metaName) {
            $model->whereHas('metadata', function ($metadata) use ($metaName, $metaValue) {
                $metadata->where('key', $metaName);
                !is_null($metaValue) && strlen($metaValue) > 0 && $metadata->where('value', $metaValue);
            });
        }

        return $model;
    }
}
