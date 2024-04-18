<?php
declare(strict_types=1);

namespace Modules\Client\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Client\Contracts\Services\ClientServiceInterface;
use Modules\Client\Services\ClientService;

class ServiceBindingProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ClientServiceInterface::class, ClientService::class);
    }
}
