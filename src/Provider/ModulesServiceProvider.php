<?php

namespace SilexModules\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;

/**
 * @author Alberto Avon <alberto.avon@gmail.com>
 */
class ModulesServiceProvider implements ServiceProviderInterface
{
    
    private $modules;
    
    public function __construct(array $modules = [])
    {
        $this->modules = $modules;
    }

    public function register(Application $app)
    {
        $modPreset = $this->modules;
        
        $app['modules'] = $app->share(function() use($app, $modPreset) {
            return new \SilexModules\ModulesRegistry($app, $modPreset);
        });
    }

    public function boot(Application $app)
    {
        // Lock the modules registry at the application bootstrap
        $app['modules']->lock();
    }

}
