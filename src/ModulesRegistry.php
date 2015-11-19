<?php

namespace SilexModules;

use Silex\Application;

/**
 * Registry for the loaded modules
 * 
 * @author Alberto Avon <alberto.avon@gmail.com>
 */
class ModulesRegistry
{

    /** @var bool */
    private $locked = false;

    /** @var Application */
    private $app;

    /** @var Module[] */
    private $modules = [];

    /**
     * @param Application $app
     * @param Module[] $modules
     */
    public function __construct(Application $app, array $modules = [])
    {
        $this->app = $app;
        $this->addModules($modules);
    }

    /**
     * Register an array of modules
     * @param Module[] $modules
     */
    public function addModules(array $modules)
    {
        foreach ($modules as $module) {
            $this->add($module);
        }
    }

    /**
     * Adds a single module
     * 
     * @param Module $module
     */
    public function add(Module $module)
    {
        if ($this->locked) {
            throw new \RuntimeException('Cannot register modules: the registry is already locked');
        }
        
        $this->modules[] = $module;
        
        // A module is by its definition a Silex\ControllerProviderInterface so
        // is possible to pass it to Silex\Application::mount() method
        $this->app->mount($module->getPrefix(), $module);
    }
    
    /**
     * Locks the registry and prevent further modules registrations
     */
    public function lock()
    {
        $this->locked = true;
    }

}
