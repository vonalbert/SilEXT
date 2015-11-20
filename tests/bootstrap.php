<?php

include __DIR__ . '/../vendor/autoload.php';

$app = new \Silex\Application([
    'debug' => true
]);

$app->register(new \Vonalbert\Silext\Provider\ModularityServiceProvider);

$app['modules']->addModules([
    new Vonalbert\Silext\Tests\Foo\FooModule,           // No route prefix for this module
    new Vonalbert\Silext\Tests\Bar\BarModule('bar')     // All routes of this module have this pattern /bar/*
]);

if (isset($app['module'])) {
    // This code won't be executed: the 'module' service is not manually set in
    // the bootstrap, but is set by the demo modules (BarModule e FooModule)
    die('Cannot start: the module service is already set');
}

$app->run();
