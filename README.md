# Silex Modules
Silex Modules is a library that allows to register routes and services in a modular fashion.

## Usage
Start by adding ```vonalbert/silex-modules``` to the dependencies in your ```composer.json```
```json
{
  "require": {
    "vonalbert/silex-modules": "*"
  }
}
```
To enable the modules feature you only need to register the ```SilexModules\Provider\ModulesServiceProvider``` service provider
```php
$app->register(new \SilexModules\Provider\ModulesServiceProvider);
```
Modules can be registered passing an array of ```SilexModules\Module``` objects to the provider constructor or using
the ```$app['modules']``` service
```php
$app->register(new \SilexModules\Provider\ModulesServiceProvider([
  // ...
  new Some\Class\Module,
  // ...
]));

$app['modules']->add(new Other\Class\Module);
```

## Implementing modules
Modules are objects extending the ```SilexModules\Module``` abstract class.
An implementation of a module require the implementation of the abstract methods ```setRoutes``` and ```bootstrap```
```php
abstract protected function setRoutes(ControllerCollection $router);
abstract protected function bootstrap(Application $app);
```

```setRoutes``` is called at registration time and accept a ```Silex\ControllerCollection``` that allows routes registration.

```bootstrap``` is called at the module bootstrapping.
A module is bootstrapped **only** if one of its routes is matching the current request.


By default modules' routes are registered without a prefix. To associate a route prefix to the module you can use one of the
following methods:

1. ```new Some\Module('/prefix')```
2. ```$module->setPrefix('/other-prefix')``` 
