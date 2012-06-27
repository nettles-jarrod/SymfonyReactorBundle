# EXPERIMENTAL Symfony Reactor Bundle

## Purpose

* Run Symfony apps under [React-PHP](https://github.com/react-php).
* See if there are real performance benefits to running Symfony under React.

## Usage

Run the following command:

```
git submodule add git://github.com/Blackshawk/SymfonyReactorBundle.git vendor/bundles/Blackshawk/SymfonyReactorBundle
```

Then register the new bundle in your autoloader and AppKernel.

```php
<?php
    // #app/autoload.php
    $loader->registerNamespaces(array(
        'Blackshawk' => __DIR__.'/../vendor/bundles',
        // your other namespaces
    ));
    
    // #app/AppKernel.php
    $bundles = array(
        new Blackshawk\SymfonyReactorBundle\BlackshawkSymfonyReactorBundle(),
        // your other bundles
    );
    
```

Open up app/config/routing.yml and register the new bundle's routing information. You may also wish to open routing_dev.yml and
comment out the default / pattern for the Acme bundle as well.

```
# app/config/routing.yml

BlackshawkSymfonyReactorBundle:
    resource: "@BlackshawkSymfonyReactorBundle/Resources/config/routing.yml"
    prefix:   /
```


After this you will need to create a new front controller for your Symfony application - I recommend calling it "app_reactor.php" in your web/ directory. (This will take the place app.php or app_dev.php.)


### Example front controller

```php
<?php
// #web/app_reactor.php

require_once __DIR__ . '/../app/bootstrap.php.cache';
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/AppKernel.php';

define('KERNEL_ROOT', __DIR__ . '/../app'); //this fixes a kernel root error you might experience

$app = new Blackshawk\SymfonyReactorBundle\Reactor\Kernel('dev', true); //run in dev mode with debug mode on
$stack = new React\Espresso\Stack($app);
$stack->listen(1337);
```

After this is in place run the following command.

```
php web/app_reactor.php
```

Now visit http://localhost:1337/hello/Jarrod to see the results. Try refreshing the page several times to see the run counter increase.