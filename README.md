# SilEXT
SilEXT is an extension library for the silex microframework.

## Installation
Just add ```vonalbert/silext``` to your ```composer.json``` and register the required service providers

## Features

### Modularity
To enable the modules feature you only need to register the ```Vonalbert\Silext\Provider\ModularityServiceProvider``` service provider
and use the ```modules``` service to register the modules objects

```php
$app->register(new \Vonalbert\Silext\Provider\ModulesServiceProvider);
$app['modules']->add(new ModuleA);
$app['modules']->addModules([
    new ModuleB('/route-prefix-b'),
    new ModuleB('/route-prefix-c'),
    // ...
]);
```

A class to recognized as module must extend the ```Vonalbert\Silext\Module``` abstract class that require the
implementation of the abstract methods ```setRoutes``` and ```bootstrap```
```php
abstract protected function setRoutes(ControllerCollection $router);
abstract protected function bootstrap(Application $app);
```

```setRoutes``` is called at registration time and accept a ```Silex\ControllerCollection``` that allows routes registration.

```bootstrap``` is called at the module bootstrapping.
A module is bootstrapped **only** if one of its routes is matching the current request.