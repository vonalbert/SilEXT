<?php

namespace Vonalbert\Silext\Tests\Bar;

use Silex\Application;

/**
 * @author Alberto Avon <alberto.avon@gmail.com>
 */
class BarController
{
    
    public function testAction(Application $app)
    {
        $method = __METHOD__;
        return $app->stream(function() use($method, $app) {
            var_dump($method, $app['module']);
        });
    }
    
}
