<?php
declare(strict_types=1);

namespace App\Modular\Commands;

use App\Modular\Concerns\ModuleDetector;
use Illuminate\Database\Console\Migrations\MigrateMakeCommand;

class ModuleMigrateMakeCommand extends MigrateMakeCommand
{
    use ModuleDetector;

    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'module:make:migration {module : The name of module} {name : The name of the migration}
        {--create= : The table to be created}
        {--table= : The table to migrate}
        {--path= : The location where the migration file should be created}
        {--realpath : Indicate any provided migration file paths are pre-resolved absolute paths}
        {--fullpath : Output the full path of the migration (Deprecated)}';

    /**
     * @return string
     */
    protected function getMigrationPath()
    {
        return $this->getModuleConventions($this->argument('module'))->migrationPath;
    }
}
