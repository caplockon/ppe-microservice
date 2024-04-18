<?php
declare(strict_types=1);

namespace Modules\Logging;

use App\Modular\ModuleServiceProvider as BaseProvider;
use Modules\Logging\Models\ApiLog;
use Modules\Logging\Providers\RepositoryBindingProvider;

class ModuleServiceProvider extends BaseProvider
{
    protected function registerServices($app): void
    {
        $app->register(RepositoryBindingProvider::class);
    }

    protected function getMorphMap(): array
    {
        return [
            'core.models.api_log' => ApiLog::class,
        ];
    }

    protected function getRouteFiles(): array
    {
        return [
            __DIR__ . '/Http/Routes/api.php',
        ];
    }
}
