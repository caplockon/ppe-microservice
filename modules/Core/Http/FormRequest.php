<?php
declare(strict_types=1);

namespace Modules\Core\Http;

use Illuminate\Contracts\Database\Query\Builder as QueryBuilder;
use \Illuminate\Contracts\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Foundation\Http\FormRequest as BaseFormRequest;
use Modules\Core\Contracts\BuilderCriteriaInterface;
use Modules\Core\Models\Model;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class FormRequest extends BaseFormRequest
{
    /**
     * @var array|BuilderCriteriaInterface[]|class-string<BuilderCriteriaInterface>[]
     */
    protected array $criteria = [];

    /**
     * @template T
     * @param T|Model|EloquentModel|QueryBuilder|EloquentBuilder $model
     * @return T|Model|EloquentModel|QueryBuilder|EloquentBuilder
     */
    public function applyCriteria(mixed $model)
    {
        foreach ($this->criteria as $criterion) {
            $criterion = $criterion instanceof BuilderCriteriaInterface
                ? $criterion
                : app($criterion, ['request' => $this]);

            $model = $criterion->apply($model);
        }

        return $model;
    }
}
