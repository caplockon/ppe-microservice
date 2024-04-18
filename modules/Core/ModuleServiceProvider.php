<?php
declare(strict_types=1);

namespace Modules\Core;

use App\Modular\ModuleServiceProvider as BaseProvider;
use Modules\Core\Providers\DatabaseServiceProvider;
use Modules\Core\Providers\SerializerServiceProvider;

class ModuleServiceProvider extends BaseProvider
{
    protected function registerServices($app): void
    {
        $app->register(DatabaseServiceProvider::class);
        $app->register(SerializerServiceProvider::class);
    }
}
