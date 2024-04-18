<?php
declare(strict_types=1);

namespace App\Modular;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Console\Command;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Seeder;
use Illuminate\Support\ServiceProvider;
use ReflectionClass;

abstract class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Define name of module
     * @var string
     */
    protected string $name = '';

    /**
     * @var ModuleConventions
     */
    private ModuleConventions $conventions;

    /**
     * Return conventions of module
     * @return ModuleConventions
     */
    final public function getConventions(): ModuleConventions
    {
        return $this->conventions ??= $this->defineConventions();
    }

    /**
     * Module conventions
     * @return ModuleConventions
     */
    protected function defineConventions(): ModuleConventions
    {
        $conventions = new ModuleConventions();

        $rf = new ReflectionClass($this);
        $conventions->modulePath = dirname($rf->getFileName());
        $conventions->namespace = $rf->getNamespaceName();
        $conventions->migrationPath = $conventions->modulePath . '/Database/Migrations';
        $conventions->seederPath = $conventions->modulePath . '/Database/Seeders';
        $conventions->translationPath = $conventions->modulePath . '/Resources/lang';
        $conventions->seederNamespace = $conventions->namespace . "\\Database\\Seeders\\";

        return $conventions;
    }

    /**
     * Boot module
     *
     * @return void
     */
    public function boot(): void
    {
        $conventions = $this->getConventions();

        // Load configurations
        $configs = $this->getConfigFiles();
        array_map(fn ($file, $name) => $this->mergeConfigFrom($file, $name), $configs, array_keys($configs));

        // Loading migrations
        $this->loadMigrationsFrom($conventions->migrationPath);

        // Loading translation
        $this->loadTranslationsFrom($conventions->translationPath, $this->name);

        // Load routes
        array_map(fn ($file) => $this->loadRoutesFrom($file), $this->getRouteFiles());

        $morphMap = $this->getMorphMap();
        if (! empty($morphMap)) {
            Relation::morphMap($morphMap);
        }
    }

    /**
     * Register
     *
     * @return void
     */
    public function register()
    {
        $this->registerServices($this->app);

        if ($this->app->runningInConsole()) {
            $this->registerForConsoleOnly();
        }
    }

    /**
     * @param Application $app
     * @return void
     */
    protected function registerServices($app): void
    {}

    /**
     * Register for console only
     *
     * @return void
     */
    protected function registerForConsoleOnly(): void
    {
        // Register commands
        $commands = $this->getCommands();
        if (!empty($commands)) {
            $this->commands($commands);
        }

        $seeders = $this->getSeeders();
        if (!empty($seeders)) {
            $this->callAfterResolving(DatabaseSeeder::class, function (DatabaseSeeder $seeder) use ($seeders) {
                $seeder->push(...$seeders);
            });
        }
    }

    /**
     * Helper method to register commands
     *
     * @return array<class-string<Command>>
     */
    protected function getCommands(): array
    {
        return [];
    }

    /**
     * Return seeders to be run
     *
     * @return array<class-string<Seeder>>
     */
    protected function getSeeders(): array
    {
        return [];
    }

    /**
     * Return the list of route files
     * @return array
     */
    protected function getRouteFiles(): array
    {
        return [];
    }

    /**
     * Return the registered config files
     * @return array
     */
    protected function getConfigFiles(): array
    {
        return [];
    }

    /**
     * Return morph map
     * @return array
     */
    protected function getMorphMap(): array
    {
        return [];
    }
}
