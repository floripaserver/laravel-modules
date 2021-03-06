<?php
namespace Llama\Modules\Commands;

use Illuminate\Console\Command;
use Llama\Modules\Exceptions\FileAlreadyExistException;
use Llama\Modules\Generators\FileGenerator;

abstract class GeneratorCommand extends Command
{
	
    /**
     * Get template contents.
     *
     * @return string
     */
    abstract protected function getTemplateContents();
    
    /**
     * Get the destination file path.
     *
     * @return string
     */
    abstract protected function getDestinationFilePath();
    
    /**
     * Execute the console command.
     */
    public function fire()
    {
        $path = str_replace('\\', '/', $this->getDestinationFilePath());
        
        if (!$this->laravel['files']->isDirectory($dir = dirname($path))) {
            $this->laravel['files']->makeDirectory($dir, 0777, true);
        }
        
        try {
            with(new FileGenerator($path, $this->getTemplateContents()))->generate();
            $this->info("Created : {$path}");
        } catch (FileAlreadyExistException $e) {
            $this->error("File : {$path} already exists.");
        }
    }
    
    /**
     * Get class name.
     *
     * @return string
     */
    public function getClass()
    {
        return class_basename($this->argument($this->argumentName));
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace()
    {
        return '';
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
        $extra = str_replace($this->getClass(), '', $this->argument($this->argumentName));
        $extra = str_replace('/', '\\', $extra);
        $namespace = $this->laravel['modules']->config('namespace');
        $namespace .= '\\' . $module->getStudlyName();
        $namespace .= '\\' . $this->getDefaultNamespace();
        $namespace .= '\\' . $extra;
        return trim($namespace, '\\');
    }
}
