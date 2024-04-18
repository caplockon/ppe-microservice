<?php
declare(strict_types=1);

namespace App\Modular;

use App\Modular\Commands\ModuleMigrateMakeCommand;
use App\Modular\Commands\ModuleSeederMakeCommand;
use Closure;
use Illuminate\Support\ServiceProvider;

class AppModulesServiceProvider extends ServiceProvider
{

    public function register()
    {
        $modules = config('modules');
        array_map(function ($module) {
            $this->app->register($module);
        }, $modules, array_keys($modules));

        $commands = $this->getModuleCommands();
        if ($this->app->runningInConsole()) {
            $this->commands(array_keys($commands));
        }
        array_map(fn ($register) => $register(), $commands);
    }

    /**
     * Module commands
     *
     * @return Closure[]
     */
    protected function getModuleCommands()
    {
        return [
            ModuleMigrateMakeCommand::class => fn () => $this->registerMakeMigrationCommand(),
            ModuleSeederMakeCommand::class => fn () => null
        ];
    }

    /**
     * @return void
     */
    public function registerMakeMigrationCommand()
    {
        $this->app->singleton(ModuleMigrateMakeCommand::class, function ($app) {
            // Once we have the migration creator registered, we will create the command
            // and inject the creator. The creator is responsible for the actual file
            // creation of the migrations, and may be extended by these developers.
            $creator = $app['migration.creator'];

            $composer = $app['composer'];

            return new ModuleMigrateMakeCommand($creator, $composer);
        });
    }
}
