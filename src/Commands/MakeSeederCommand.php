<?php

namespace Llama\Modules\Commands;

use Illuminate\Support\Str;
use Llama\Modules\Support\Stub;
use Llama\Modules\Traits\CanClearModulesCache;
use Llama\Modules\Traits\ModuleCommandTrait;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MakeSeederCommand extends BaseCommand
{
    use ModuleCommandTrait, CanClearModulesCache;

    protected $argumentName = 'name';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:make-seeder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate new seeder for the specified module.';

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of seeder will be created.'],
            ['module', InputArgument::OPTIONAL, 'The name of module will be used.']
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            [
                'master',
                null,
                InputOption::VALUE_NONE,
                'Indicates the seeder will created is a master database seeder.'
            ],
        ];
    }

    /**
     * @return mixed
     */
    protected function getTemplateContents()
    {
        $module = $this->laravel['modules']->findOrFail($this->getModuleName());

        return (new Stub('/seeder.stub', [
        	'CLASS' => $this->getClassName(),
            'MODULE' => $this->getModuleName(),
            'NAMESPACE' => $this->getClassNamespace($module)
        ]))->render();
    }

    /**
     * @return mixed
     */
    protected function getDestinationFilePath()
    {
        $this->clearCache();

        $path = $this->laravel['modules']->getModulePath($this->getModuleName());

        return $path . $this->getDefaultNamespace() . '/' . $this->getClassName() . '.php';
    }

    /**
     * @return string
     */
    private function getClassName()
    {
        return Str::studly($this->argument('name')) . ($this->option('master') ? 'DatabaseSeeder' : 'TableSeeder');
    }

    /**
     * Get class namespace.
     *
     * @param \Llama\Modules\Module $module
     *
     * @return string
     */
    public function getClassNamespace($module)
    {
        return parent::getClassNamespace($module) . '\\' . trim(str_replace('/', '\\', $this->getDefaultNamespace()), '\\');
    }

    /**
     * Get default namespace.
     *
     * @return string
     */
    public function getDefaultNamespace()
    {
        return $this->laravel['modules']->config('paths.generator.seed', 'Database/Seeds');
    }
}
