<?php
declare(strict_types=1);

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{
    /**
     * Static table name of model
     * @return string
     */
    public static function tableName(): string
    {
        return (new static())->getTable();
    }
}
