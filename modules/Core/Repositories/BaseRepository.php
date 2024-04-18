<?php
declare(strict_types=1);

namespace Modules\Core\Repositories;

use Modules\Core\Contracts\RepositoryInterface;
use Modules\Core\Models\Model;

/**
 * @mixin Model
 */
class BaseRepository implements RepositoryInterface
{
    /**
     * @var string
     */
    protected string $model = '';

    /**
     * @inheritDoc
     */
    public function save($model)
    {
        $model->save();
    }

    /**
     * @param $method
     * @param $args
     * @return mixed
     */
    public function __call($method, $args)
    {
        return call_user_func_array([$this->model, $method], $args);
    }
}
