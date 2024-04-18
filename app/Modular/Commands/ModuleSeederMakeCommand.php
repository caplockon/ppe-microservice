<?php
declare(strict_types=1);

namespace App\Modular\Commands;

use App\Modular\Concerns\ModuleDetector;
use Illuminate\Database\Console\Seeds\SeederMakeCommand;
use Illuminate\Support\Str;

class ModuleSeederMakeCommand extends SeederMakeCommand
{
    use ModuleDetector;

    protected $signature = 'module:make:seeder {module : The name of module} {name : The name of seeder}';

    protected function getPath($name)
    {
        $name = str_replace('\\', '/', Str::replaceFirst($this->rootNamespace(), '', $name));
        return $this->getModuleConventions($this->argument('module'))->seederPath . '/' . $name . '.php';
    }

   protected function rootNamespace()
   {
       return $this->getModuleConventions($this->argument('module'))->seederNamespace;
   }
}
