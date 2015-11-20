<?php

namespace Vonalbert\Silext\Tests\Foo;

use Silex\Application;
use Silex\ControllerCollection;
use Vonalbert\Silext\Module;

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
        $router->get('/', 'Vonalbert\Silext\Tests\Foo\Controller::testAction');
    }

}
