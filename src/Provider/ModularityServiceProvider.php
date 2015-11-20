<?php

namespace Vonalbert\Silext\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;

/**
 * @author Alberto Avon <alberto.avon@gmail.com>
 */
class ModularityServiceProvider implements ServiceProviderInterface
{
    
    public function register(Application $app)
    {
        $app['modules'] = $app->share(function() use($app) {
            return new \Vonalbert\Silext\ModulesRegistry($app);
        });
    }

    public function boot(Application $app)
    {
        // Lock the modules registry at the application bootstrap
        $app['modules']->lock();
    }

}
