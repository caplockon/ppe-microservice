<?php
declare(strict_types=1);

namespace Modules\Client;

use App\Modular\ModuleServiceProvider as BaseProvider;
use Modules\Client\Models\Client;
use Modules\Client\Providers\RepositoryBindingProvider;
use Modules\Client\Providers\ServiceBindingProvider;

class ModuleServiceProvider extends BaseProvider
{
    /**
     * @inheritDoc
     */
    protected function registerServices($app): void
    {
        $app->register(RepositoryBindingProvider::class);
        $app->register(ServiceBindingProvider::class);
    }

    /**
     * @inheritDoc
     */
    protected function getRouteFiles(): array
    {
        return [
            __DIR__ . '/Http/Routes/api.php',
        ];
    }

    protected function getMorphMap(): array
    {
        return [
            'client.models.client' => Client::class,
        ];
    }
}
