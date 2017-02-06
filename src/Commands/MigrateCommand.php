<?php

namespace Llama\Modules\Commands;

use Llama\Modules\Migrations\Migrator;
use Llama\Modules\Module;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Console\Command as BaseCommand;

class MigrateCommand extends BaseCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate the migrations from the specified module or from all modules.';

    /**
     * @var \Llama\Modules\Repository
     */
    protected $module;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $this->module = $this->laravel['modules'];

        if ($name = $this->argument('module')) {
            $module = $this->module->findOrFail($name);
	        $this->call('migrate', [
	            '--path' => str_replace(base_path(), '', (new Migrator($module))->getPath()),
	            '--database' => $this->option('database'),
	            '--pretend' => $this->option('pretend'),
	            '--force' => $this->option('force'),
	        ]);
	
	        if ($this->option('seed')) {
	            $this->call('module:seed', ['module' => $module->getName()]);
	        }
        } else {
        	$this->call('module:publish-migration');
        	$this->call('migrate', [
        			'--database' => $this->option('database'),
        			'--pretend' => $this->option('pretend'),
        			'--force' => $this->option('force'),
        	]);
        	
        	if ($this->option('seed')) {
        		$this->call('module:seed');
        	}
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('module', InputArgument::OPTIONAL, 'The name of module will be used.'),
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
            array('direction', 'd', InputOption::VALUE_OPTIONAL, 'The direction of ordering.', 'asc'),
            array('database', null, InputOption::VALUE_OPTIONAL, 'The database connection to use.'),
            array('pretend', null, InputOption::VALUE_NONE, 'Dump the SQL queries that would be run.'),
            array('force', null, InputOption::VALUE_NONE, 'Force the operation to run when in production.'),
            array('seed', null, InputOption::VALUE_NONE, 'Indicates if the seed task should be re-run.'),
        );
    }
}
