<?php

namespace SilexModules\Tests\Foo;

use Silex\Application;
use Silex\ControllerCollection;
use SilexModules\Module;

/**
 * @author Alberto Avon <alberto.avon@gmail.com>
 */
class FooModule extends Module
{

    protected function bootstrap(Application $app)
    {
        $app['module'] = $this;
    }

    protected function setRoutes(ControllerCollection $router)
    {
        $router->get('/', 'SilexModules\Tests\Foo\Controller::testAction');
    }

}
