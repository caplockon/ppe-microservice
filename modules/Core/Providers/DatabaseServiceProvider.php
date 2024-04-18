<?php
declare(strict_types=1);

namespace Modules\Core\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Modules\Core\Helpers\DebugHelper;

class DatabaseServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if (env('ENABLE_DATABASE_LOG', false)) {
            $this->listenDatabaseQuery();
        }
    }

    /**
     * @return void
     */
    public function listenDatabaseQuery(): void
    {
        DB::listen(function($query) {
            $lines = [
                sprintf("%s (%s)",  DebugHelper::toSql($query, 'QueryExecuted'), $query->time),
            ];
            $logString = implode(PHP_EOL, $lines);
            $path = storage_path(sprintf('logs/query-%s.log', date('y-m-d')));
            File::append($path, $logString . PHP_EOL);
        });
    }
}
