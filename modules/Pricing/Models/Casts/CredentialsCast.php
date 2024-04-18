<?php
declare(strict_types=1);

namespace Modules\Pricing\Models\Casts;

use Amz\Customer\Helpers\PhoneHelper;
use Illuminate\Contracts\Database\Eloquent\Castable;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Modules\Pricing\Contracts\Services\PricingServiceInterface;
use Modules\Pricing\Models\ClientPricingEngine;

class CredentialsCast implements Castable
{
    public static function castUsing(array $arguments)
    {
        return new class implements CastsAttributes
        {
            /**
             * @param ClientPricingEngine $model
             * @param $key
             * @param $value
             * @param $attributes
             * @return void
             */
            public function get($model, $key, $value, $attributes)
            {
                if (!$value) {
                    return $value;
                }

                $data = json_decode($value, true);
                if (false === $data) {
                    return null;
                }

                /** @var PricingServiceInterface $service */
                $service = app(PricingServiceInterface::class);
                $engineDriver = $model->engine_driver ? $service->getEngine($model->engine_driver) : null;
                return $engineDriver?->decryptCredentials($data) ?? $data;
            }

            /**
             * @param ClientPricingEngine $model
             * @param $key
             * @param $value
             * @param $attributes
             * @return mixed|null
             */
            public function set($model, $key, $value, $attributes)
            {
                if (!$value) {
                    return $value;
                }

                /** @var PricingServiceInterface $service */
                $service = app(PricingServiceInterface::class);
                $engineDriver = $model->engine_driver ? $service->getEngine($model->engine_driver) : null;
                $value = $engineDriver?->encryptCredentials($value) ?? $value;
                return json_encode($value);
            }
        };
    }
}
