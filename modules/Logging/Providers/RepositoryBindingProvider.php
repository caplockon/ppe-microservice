<?php
declare(strict_types=1);

namespace Modules\Logging\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Logging\Contracts\Repositories\ApiLogRepositoryInterface;
use Modules\Logging\Repositories\ApiLogRepository;

class RepositoryBindingProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ApiLogRepositoryInterface::class, ApiLogRepository::class);
    }
}
