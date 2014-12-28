
Laravel Contracts - Cheat Sheet
========

Build your own custom cheat sheet for the Laravel 5 Contracts.
The generator utilizes the Reflection API and composer to stay
current with the [contracts repository](https://github.com/illuminate/contracts).

Demo
------

You can view a sample of the cheet sheet here
[http://ryantbrown.io/laravel-contracts-cheat-sheet](http://ryantbrown.io/laravel-contracts-cheat-sheet)

Download and Run
------

Clone the repo and install the dependencies
* ```git clone https://github.com/ryantbrown/laravel-contracts-cheat-sheet.git laravel-contracts```
* ```cd laravel-contracts && composer install```

Generate the static documents (will be placed in the ```dist``` folder)
* ```php commands/generate.php generate```

Navigate to the ```dist``` folder and start a server
* ```cd dist && php -S localhost:8000```

If you want to view it without a webserver you'll need to start chrome like so:
* ```open -a Google\ Chrome --args -–disable-web-security``` and then browse to ```dist/index.html```


Build your own custom Cheat Sheet
------

The ```LC\Helper``` class makes it easy to create your own cheat sheet UI anyway
you see fit. Below is a quick and dirty script to generate the basic data used
in the cheat sheet.  Take a look at the ```src``` directory for all the classes
and methods available.

```php
<?php
// include the autoload file
require 'vendor/autoload.php'

// Get an array of all the contracts, grouped by top-level directory
$contracts = LC\Helper::getContracts();

// loop through each contract group
foreach($contracts as $group => $interfaces)
{
    // group name (parent folder for set of interfaces)
    echo $group;

    // loop through all the interfaces associated with the contract group
    foreach($interfaces as $interface)
    {
        // interace name
        echo $interface;

        // create a reflector instance for the interface
        $reflector = LC\Helper::getReflector($group, $interface);

        // grab any constants the interface has
        $constants = $reflector->getConstants();

        // $name => $value array of constants
        echo "<pre>"; print_r($constants); echo "</pre>";

        // grab an array of all the interface methods and their info
        $methods = $reflector->getMethodData();

        // loop through methods with access to all important information
        foreach($methods as $method)
        {
            // method name
            echo $method['name'];

            // method doc comment
            echo $method['doc'];

            // number of params
            echo $method['param_info']['total'];

            foreach($method['param_info']['params'] as $param)
            {
                // param name
                echo $param['name'];

                // extra param details
                $param['position']
                $param['allows_null']
                $param['is_array']
                $param['is_callable']
                $param['is_optional']
            }
        }
    }
}
```

With the above script you can pretty much generate any UI you want. If you want to generate a
static build like the [example](http://ryantbrown.io/laravel-contracts-cheat-sheet) then take
a look at the ```LC\Presenters``` and the ```LC\Commands\GenerateCommand``` classes.  In a
nutshell the command uses the presenters as a data source and generates ```html``` files
from the twig templates.

**Note:** ```LC\Helper::getReflector``` does not return an instance of PHP's ```ReflectionClass``` but rather a
instance of ```LC\Reflector```, which has several useful methods for creating the cheat sheet.
If you want access to a ```ReflectionClass``` instance then either of the following will work:

```php
// use static helper method to generate reflection instance
$class = (LC\Helper::getReflector($group, $interface))->getReflectionInstance();

// use the Reflector class to generate an instance
$class = (new LC\Reflector(Helper::getClassNamespace($group, $file)))->getReflectionInstance();
```

Customize the existing example
------

If you want to just tweak the example cheat sheet you can do that as well.

* Install the node modules with ```sudo npm install```
* Edit the ```twig```, ```less``` and ```js``` files in the ```assets``` directory
* You may need to modify the ```gulpfile.js``` and run ```gulp``` to rebuild the assets
* Re-generate the static html files with ```php commands/generate.php generate```
* Start the server ```cd dist && php -S localhost:8000```

Stay up to date with the Contracts Respository
------

As the [contracts](https://github.com/illuminate/contracts) change you can keep your cheat sheet up to date by updating the composer dependency.

* Update the contracts with ```composer update```
* Re-generate the static classes ```php commands/generate.php generate```


That's it, this was a christmas/weekend project so I hope you find it useful.