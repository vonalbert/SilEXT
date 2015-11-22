<?php

namespace Vonalbert\Silext;

use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;

/**
 * @author Alberto Avon <alberto.avon@gmail.com>
 */
abstract class Module implements ControllerProviderInterface
{

    /**
     * @var Module
     */
    private static $current;

    /**
     * Get the currently active module instance, null if none
     * 
     * @return Module|null
     */
    public static function getCurrent()
    {
        return self::$current;
    }

    /**
     * Register routes
     * 
     * @param ControllerCollection $router
     */
    abstract protected function setRoutes(ControllerCollection $router);

    /**
     * Method ran when a module's route matches the request
     * 
     * @param Application $app
     */
    abstract protected function bootstrap(Application $app);

    /**
     * Get an instance of the module controller collection
     * 
     * @param Application $app
     * @return ControllerCollection
     */
    protected function getControllersCollection(Application $app)
    {
        return $app['controllers_factory'];
    }

    /**
     * {@inherit-docs}
     */
    public function connect(Application $app)
    {
        $controllers = $this->getControllersCollection($app);
        $this->setRoutes($controllers);

        // Register a middleware for the module's controllers collection.
        // This middleware will register the services at the module startup
        $previous = null;
        $module = $this;
        
        $controllers->before(function() use($module, $app, &$previous) {
            // Start the module and store the currently active
            $previous = self::getCurrent();
            self::$current = $module;
            $module->bootstrap($app);
        });
        
        $controllers->after(function() use(&$previous) {
            // End the module code and restore the previous module
            self::$current = $previous;
        });

        return $controllers;
    }

}
