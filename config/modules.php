<?php
declare(strict_types=1);

return [
    'core' => Modules\Core\ModuleServiceProvider::class,
    'shared' => Modules\Shared\ModuleServiceProvider::class,
    'logging' => Modules\Logging\ModuleServiceProvider::class,
    'client' => Modules\Client\ModuleServiceProvider::class,
    'pricing' => Modules\Pricing\ModuleServiceProvider::class,
];
