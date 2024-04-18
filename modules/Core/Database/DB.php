<?php
declare(strict_types=1);

namespace Modules\Core\Database;

use Illuminate\Support\Facades\DB as BaseDB;
use Modules\Core\Contracts\DatabaseFunctionInterface;
use Modules\Core\Database\FunctionDrivers\PostgreFunctionDriver;

class DB extends BaseDB
{
    /**
     * @return DatabaseFunctionInterface
     */
    public static function fn(): DatabaseFunctionInterface
    {
        return new PostgreFunctionDriver();
    }
}
