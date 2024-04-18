<?php
declare(strict_types=1);

namespace Modules\Client\Http\Requests;

use Modules\Core\Http\FormRequest;
use Modules\Pricing\Contracts\Services\PricingServiceInterface;

class SubscribeClientRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return array_merge([
            'uname' => 'required|string',
            'name' => 'required|string',
            'pricing_engine' => 'required|array',
            'pricing_engine.engine_driver' => 'required|in:' . implode(",", $this->getSupportedPPEType()),
            'pricing_engine.engine_credentials' => 'required|array',
        ], $this->getEngineCredentialsValidationRules($this->get('pricing_engine')['engine_driver'] ?? null, 'pricing_engine.engine_credentials'));
    }

    /**
     * @return array
     */
    protected function getSupportedPPEType(): array
    {
        /** @var PricingServiceInterface $pricingService */
        $pricingService = app(PricingServiceInterface::class);
        return array_keys($pricingService->getAvailableEngines());
    }

    /**
     * @param string|null $engineDriver
     * @param string|null $path
     * @return array
     */
    protected function getEngineCredentialsValidationRules(?string $engineDriver, ?string $path = null): array
    {
        /** @var PricingServiceInterface $pricingService */
        $pricingService = app(PricingServiceInterface::class);

        $engine = $pricingService->getEngine($engineDriver);
        $rules = $engine->getCredentialsValidationRules();
        if ($path) {
            $rules = collect($rules)->keyBy(function ($value, $key) use ($path) {
                return $path . "." . $key;
            })->all();
        }

        return $rules;
    }
}
