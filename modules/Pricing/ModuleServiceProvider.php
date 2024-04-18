<?php
declare(strict_types=1);

namespace Modules\Pricing;

use App\Modular\ModuleServiceProvider as BaseProvider;
use Modules\Pricing\Models\ClientPricingEngine;
use Modules\Pricing\Providers\ServiceBindingProvider;

class ModuleServiceProvider extends BaseProvider
{
    protected function registerServices($app): void
    {
        $app->register(ServiceBindingProvider::class);
    }

    protected function getRouteFiles(): array
    {
        return [
            __DIR__ . '/Http/Routes/api.php',
        ];
    }

    protected function getMorphMap(): array
    {
        return [
            'pricing.models.client_pricing_engine' => ClientPricingEngine::class,
        ];
    }
}
