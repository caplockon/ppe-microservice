<?php
declare(strict_types=1);

namespace App\Modular;

class ModuleConventions
{
    /**
     * Define the path of module
     * @var string
     */
    public string $modulePath;

    /**
     * Name space of module
     * @var string
     */
    public string $namespace;

    /**
     * Define the path of migration
     * @var string
     */
    public string $migrationPath;

    /**
     * Define the path of seeders
     * @var string
     */
    public string $seederPath;

    /**
     * Namespace of seeder class
     * @var string
     */
    public string $seederNamespace;

    /**
     * Define the path of translation
     * @var string
     */
    public string $translationPath;
}
