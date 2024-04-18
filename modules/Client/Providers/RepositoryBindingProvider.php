<?php
declare(strict_types=1);

namespace Modules\Client\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Client\Contracts\Repositories\ClientRepositoryInterface;
use Modules\Client\Repositories\ClientRepository;

class RepositoryBindingProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ClientRepositoryInterface::class, ClientRepository::class);
    }
}
