<?php
declare(strict_types=1);

namespace App\Modular\Concerns;

use App\Modular\ModuleConventions;
use App\Modular\ModuleServiceProvider;
use InvalidArgumentException;

trait ModuleDetector
{
    public function getModuleConventions(string $module): ModuleConventions
    {
        $providerClass = $module ? config("modules.$module") : null;

        /** @var ModuleServiceProvider $provider */
        $provider = $providerClass ? new $providerClass(app()) : null;
        if (empty($provider)) {
            throw new InvalidArgumentException("Module `$module` not found");
        }

        return $provider->getConventions();
    }
}
