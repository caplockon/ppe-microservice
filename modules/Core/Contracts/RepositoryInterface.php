<?php
declare(strict_types=1);

namespace Modules\Core\Contracts;

use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    /**
     * @param Model $model
     * @return mixed
     */
    public function save($model);
}
