<?php

include __DIR__ . '/../vendor/autoload.php';

$app = new \Silex\Application([
    'debug' => true
]);

$app->register(new \SilexModules\Provider\ModulesServiceProvider([
    new SilexModules\Tests\Foo\FooModule('')
]));

$app['modules']->add(new SilexModules\Tests\Bar\BarModule('bar'));

if (isset($app['module'])) {
    // This code won't be executed: the 'module' service is not manually set in
    // the bootstrap, but is set by the demo modules (BarModule e FooModule)
    die('Cannot start: the module service is already set');
}

$app->run();
