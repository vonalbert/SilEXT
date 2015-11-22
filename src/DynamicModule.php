<?php

namespace Vonalbert\Silext;

use Silex\Application;
use Silex\ControllerCollection;

/**
 * Generic module implementation that allows to define module behaviour using
 * closures
 *
 * @author Alberto Avon <alberto.avon@gmail.com>
 */
class DynamicModule extends Module
{

    /** @var callable */
    protected $fnBootstrap;

    /** @var callable */
    protected $fnSetRoutes;
    
    /**
     * Initialize the empty module
     */
    public function __construct()
    {
        $this->fnBootstrap = function() {};
        $this->fnSetRoutes = function() {};
    }

    /**
     * Set the service configuration handler.
     * The callable should accept a Silex\Application instance as argument
     * 
     * @param callable $fnBootstrap
     */
    public function setBootstrapHandler(callable $fnBootstrap)
    {
        $this->fnBootstrap = $fnBootstrap;
    }

    /**
     * Set the route configuration handler
     * The callable should accept a Silex\ControllerCollection instance as
     * argument
     * 
     * @param callable $fnSetRoutes
     */
    public function setSetRoutesHandler(callable $fnSetRoutes)
    {
        $this->fnSetRoutes = $fnSetRoutes;
    }

    /**
     * {@inheritdoc}
     */
    protected function bootstrap(Application $app)
    {
        $this->fnBootstrap($app);
    }

    /**
     * {@inheritdoc}
     */
    protected function setRoutes(ControllerCollection $router)
    {
        return $this->fnSetRoutes($router);
    }

}
