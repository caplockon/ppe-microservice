<?php
declare(strict_types=1);

namespace Modules\Core\Contracts;

use Illuminate\Contracts\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Contracts\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Modules\Core\Models\Model;

interface BuilderCriteriaInterface
{
    /**
     * @template T
     * @param T|Model|EloquentModel|QueryBuilder|EloquentBuilder $model
     * @return T|Model|EloquentModel|QueryBuilder|EloquentBuilder
     */
    public function apply(mixed $model): mixed;
}
