<?php

namespace Vonalbert\Silext\Tests;

/**
 * @author Alberto
 */
class ModulesTests extends \PHPUnit_Framework_TestCase
{

    public function testProvider()
    {
        $app = new \Silex\Application;
        $app->register(new \Vonalbert\Silext\Provider\ModularityServiceProvider);
        $this->assertTrue(isset($app['modules']));
        $this->assertInstanceOf('Vonalbert\Silext\ModulesRegistry', $app['modules']);

        // ModuleRegister should be locked
        $app->boot();

        try {
            $app['modules']->add(new TestModuleA);
        } catch (Exception $ex) {
            $this->assertInstanceOf('RuntimeException', $ex);
        }
        $this->fail();
    }

}

class TestModuleA extends Vonalbert\Silext\Module
{

    protected function bootstrap(\Silex\Application $app)
    {
        
    }

    protected function setRoutes(\Silex\ControllerCollection $router)
    {
        
    }

}
