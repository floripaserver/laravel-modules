<?php

namespace Llama\Modules\Commands;

use Illuminate\Support\Str;
use Llama\Modules\Support\Migrations\NameParser;
use Llama\Modules\Support\Migrations\SchemaParser;
use Llama\Modules\Support\Stub;
use Llama\Modules\Traits\ModuleCommandTrait;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Console\GeneratorCommand;

class MakeMigrationCommand extends GeneratorCommand
{
    use ModuleCommandTrait;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:make-migration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new migration for the specified module.';

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('name', InputArgument::REQUIRED, 'The migration name will be created.'),
            array('module', InputArgument::OPTIONAL, 'The name of module will be created.'),
        );
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
            array('fields', null, InputOption::VALUE_OPTIONAL, 'The specified fields table.', null),
            array('plain', null, InputOption::VALUE_NONE, 'Create plain migration.'),
        );
    }

    /**
     * Get schema parser.
     *
     * @return SchemaParser
     */
    public function getSchemaParser()
    {
        return new SchemaParser($this->option('fields'));
    }

    /**
     * @throws \InvalidArgumentException
     *
     * @return mixed
     */
    protected function getTemplateContents()
    {
        $parser = new NameParser($this->argument('name'));

        if ($parser->isCreate()) {
            return Stub::create($this->getStub(), [
                'class' => $this->getClass(),
                'table' => $parser->getTableName(),
                'fields' => $this->getSchemaParser()->render(),
            ]);
        }
        if ($parser->isAdd()) {
            return Stub::create($this->getStub(), [
                'class' => $this->getClass(),
                'table' => $parser->getTableName(),
                'fields_up' => $this->getSchemaParser()->up(),
                'fields_down' => $this->getSchemaParser()->down(),
            ]);
        }
        
        if ($parser->isDelete()) {
            return Stub::create($this->getStub(), [
                'class' => $this->getClass(),
                'table' => $parser->getTableName(),
                'fields_down' => $this->getSchemaParser()->up(),
                'fields_up' => $this->getSchemaParser()->down(),
            ]);
        }
        
        if ($parser->isDrop()) {
            return Stub::create($this->getStub(), [
                'class' => $this->getClass(),
                'table' => $parser->getTableName(),
                'fields' => $this->getSchemaParser()->render(),
            ]);
        }

        return Stub::create($this->getStub(), [
            'class' => $this->getClass(),
        ]);
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub() 
    {
    	$parser = new NameParser($this->argument('name'));
    	
    	if ($parser->isCreate()) {
    		return __DIR__ . '/stubs/migration/create.stub';
    	}
    	
    	if ($parser->isAdd()) {
    		return __DIR__ . '/stubs/migration/add.stub';
    	}
    	
    	if ($parser->isDelete()) {
    		return __DIR__ . '/stubs/migration/delete.stub';
    	}
    	
    	if ($parser->isDrop()) {
    		return __DIR__ . '/stubs/migration/drop.stub';
    	}
    	
    	return __DIR__ . '/stubs/migration/plain.stub';
    }

    /**
     * @return mixed
     */
    protected function getDestinationFilePath()
    {
        $path = $this->laravel['modules']->getModulePath($this->getModuleName());

        $generatorPath = $this->laravel['modules']->config('paths.generator.migration');

        return $path . $generatorPath . '/' . $this->getFileName() . '.php';
    }

    /**
     * @return string
     */
    private function getFileName()
    {
        return date('Y_m_d_His_') . $this->getSchemaName();
    }

    /**
     * @return array|string
     */
    private function getSchemaName()
    {
        return $this->argument('name');
    }

    /**
     * @return string
     */
    private function getClassName()
    {
        return Str::studly($this->argument('name'));
    }

    public function getClass()
    {
        return $this->getClassName();
    }

    /**
     * Run the command.
     */
    public function fire()
    {
        parent::fire();

        if (app()->environment() === 'testing') {
            return;
        }
        $this->call('optimize');
    }
}
