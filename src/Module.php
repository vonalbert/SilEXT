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

    /** @var string */
    protected $prefix;

    /**
     * @param string $prefix    The route prefix used when registering the
     *                          module
     */
    final public function __construct($prefix = '/')
    {
        $this->setPrefix($prefix);
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
        $module = $this;
        $controllers->before(function() use($module, $app) {
            $module->bootstrap($app);
        });

        return $controllers;
    }
    
    /**
     * Get the route prefix
     * 
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * Set route prefix used at the module's registration
     * 
     * @param string $prefix
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
    }
    
}
