
Laravel Contracts - Cheat Sheet
========

Customize and then generate your own static cheat sheet for the Laravel 5 Contracts. The generator utilizes the Reflection API and composer to stay current with the [contracts repository](https://github.com/illuminate/contracts).

Demo
------

You can view a sample of the cheet sheet here [http://ryantbrown.io/laravel-contracts](http://ryantbrown.io/laravel-contracts)

Download and Run
------

Clone the repo and install the dependencies
* ```git clone https://github.com/ryantbrown/laravel-contracts-cheat-sheet.git laravel-contracts```
* ```cd laravel-contracts```
* ```composer install```
Generate the static documents (inside the dist folder)
* ```php commands/generate.php generate```
Navigate to the dist folder and start a server
* ```cd dist```
* ```php -S localhost:8000```
If you want to view it without a webserver you'll need to start chrome like so:
* ```open -a Google\ Chrome --args -–disable-web-security```
Then you can open the ```dist/index.html``` file

Customize Example Template
------

Install the node modules
```sudo npm install```
Edit the less and javascript via the assets directory
Modify the gulpfile.js per your changes
Modify the twig templates (```assets/templates```)
Generate the static files (index.html and classes/*.html)
```php commands/generate.php generate```


Build your own custom Cheat Sheet
------

Below is a quick and dirty script to generate the basic data used in the cheat sheet.  Take a look at the ```src``` directory for all the classes and methods available.

```php
<?php
// include the autoload file
require 'vendor/autoload.php'

// Get an array of all the contracts, grouped by top-level directory
$contracts = LC\Helper::getContracts();

foreach($contracts as $group => $files)
{
    echo $group;

    foreach($files as $file)
    {
        echo $file;

        $reflector = LC\Helper::getReflector($group, $file);

        $constants = $reflector->getConstants();

        // key => val array of constants
        echo "<pre>"; print_r($constants); echo "</pre>";

        // array of all methods and their information
        $methods = $reflector->getMethodData();

        foreach($methods as $method)
        {
            // method name
            echo $method['name'];
            // method doc comment
            echo $method['doc'];
            // number of params
            echo "<br>No. of params: " . $method['param_info']['total']

            foreach($method['param_info']['params'] as $param)
            {
                // param name
                echo "Param: " . $param['name'];

                // param details
                //$param['position']
                //$param['allows_null']
                //$param['is_array']
                //$param['is_callable']
                //$param['is_optional']
            }
        }
    }
}
```

With the above script you can pretty much generate any UI you want.