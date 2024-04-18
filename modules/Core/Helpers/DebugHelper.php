<?php
declare(strict_types=1);

namespace Modules\Core\Helpers;

use Carbon\Carbon;
use DateTime;
use Throwable;

class DebugHelper
{
    /**
     * Combines SQL and its bindings
     *
     * @param $query
     * @return string
     */
    public static function toSql($query, $type = 'default')
    {
        switch ($type) {
            case 'QueryExecuted':
                $sql = $query->sql;
                $binding = $query->bindings;
                break;
            default:
                $sql = $query->toSql();
                $binding = $query->getBindings();
                break;

        }
        $result = '';
        try {
            $sql = str_replace(array('%', '?'), array('%%', '%s'), $sql);

            $result = vsprintf($sql, collect($binding)->map(function ($binding) {
                if (is_object($binding)) {
                    if ($binding instanceof DateTime || $binding instanceof Carbon) {
                        $binding = $binding->format('Y-m-d H:i:s');
                    } else {
                        //Can't parse binding
                        return '';
                    }
                }
                if (is_String($binding)) {
                    $binding = addslashes($binding);
                    $binding = "'{$binding}'";
                }
                if (is_null($binding) || is_bool($binding)) {
                    $binding = var_export($binding, true);
                }


                return $binding;
            })->toArray());
        } catch (Throwable $e) {
            //Do nothing, skip error reporting
        }
        return $result;
    }
}
