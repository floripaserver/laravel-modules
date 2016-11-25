<?php

namespace Llama\Modules\Migrations;

use Illuminate\Support\Collection;
use Llama\Modules\Module;

class Seeder
{
    /**
     * Pingpong Module instance.
     *
     * @var \Llama\Modules\Module
     */
    protected $module;

    /**
     * Laravel Application instance.
     *
     * @var \Illuminate\Foundation\Application.
     */
    protected $laravel;

    /**
     * The database connection to be used
     *
     * @var string
     */
    protected $database = '';

    /**
     * Create new instance.
     *
     * @param \Llama\Modules\Module $module
     */
    public function __construct(Module $module)
    {
        $this->module = $module;
        $this->laravel = $module->getLaravel();
    }

    /**
     * Set the database connection to be used
     *
     * @param $database
     *
     * @return $this
     */
    public function setDatabase($database)
    {
        if (is_string($database) && $database) {
            $this->database = $database;
        }
    }

    /**
     * @return Module
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * Get seed path.
     *
     * @return string
     */
    public function getPath()
    {
        $config = $this->module->get('seed');

        $path = (is_array($config) && array_key_exists('path', $config)) ? $config['path'] : config('modules.paths.generator.seed');

        return $this->module->getExtraPath($path);
    }

    /**
     * Get seed files.
     *
     * @param boolean $reverse
     * @return array
     */
    public function getSeeds($reverse = false)
    {
        $files = $this->laravel['files']->glob($this->getPath() . '/*_*.php');

        // Once we have the array of files in the directory we will just remove the
        // extension and take the basename of the file which is all we need when
        // finding the seeds that haven't been run against the databases.
        if ($files === false) {
            return array();
        }

        $files = array_map(function ($file) {
            return str_replace('.php', '', basename($file));

        }, $files);

        // Once we have all of the formatted file names we will sort them and since
        // they all start with a timestamp this should give us the seeds in
        // the order they were actually created by the application developers.
        sort($files);

        if ($reverse) {
            return array_reverse($files);
        }

        return $files;
    }
}
