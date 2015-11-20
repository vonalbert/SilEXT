<?php

namespace Vonalbert\Silext\Tests\Foo;

use Silex\Application;

/**
 * @author Alberto Avon <alberto.avon@gmail.com>
 */
class Controller
{
    
    public function testAction(Application $app)
    {
        $method = __METHOD__;
        return $app->stream(function() use($method, $app) {
            var_dump($method, $app['module']);
        });
    }
    
}
