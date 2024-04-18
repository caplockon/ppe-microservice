<?php
declare(strict_types=1);

namespace Modules\Pricing\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Pricing\Contracts\Services\PricingServiceInterface;
use Modules\Pricing\Engines\LenderPrice\LenderPriceEngine;
use Modules\Pricing\Services\PricingService;

class ServiceBindingProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(PricingServiceInterface::class, function ($app) {
            $service = $app->make(PricingService::class);
            collect($this->pricingEngines())->each(fn ($driver, $name) => $service->setEngine($name, $driver));
            return $service;
        });
    }

    /**
     * @return string[]
     */
    protected function pricingEngines(): array
    {
        return [
            'LenderPrice' => LenderPriceEngine::class,
        ];
    }
}
