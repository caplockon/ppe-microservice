<?php
declare(strict_types=1);

namespace Modules\Core\Database\FunctionDrivers;

use Illuminate\Contracts\Database\Query\Expression;
use Modules\Core\Contracts\DatabaseFunctionInterface;
use Modules\Core\Database\DB;

class PostgreFunctionDriver implements DatabaseFunctionInterface
{

    /**
     * @return Expression|string
     */
    public function uid(): mixed
    {
        return DB::raw('(gen_random_uuid ())');
    }
}
