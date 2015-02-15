# Promise for Laravel 5

[![Latest Stable Version](https://poser.pugx.org/torann/promise/v/stable.png)](https://packagist.org/packages/torann/promise) [![Total Downloads](https://poser.pugx.org/torann/promise/downloads.png)](https://packagist.org/packages/torann/promise) [![Build Status](https://api.travis-ci.org/Torann/laravel-promise.png)](http://travis-ci.org/Torann/laravel-promise)

Simple Roles and Permissions for Laravel 5. [Homepage](http://lyften.com/projects/laravel-promise/)

----------

## Installation

- [Promise on Packagist](https://packagist.org/packages/torann/promise)
- [Promise on GitHub](https://github.com/torann/laravel-promise)
- [Laravel 4 Installation](http://lyften.com/projects/laravel-promise/doc/laravel-4.html)

To get the latest version of Promise simply require it in your `composer.json` file.

~~~
"torann/promise": "0.2.*@dev"
~~~

You'll then need to run `composer install` to download it and have the autoloader updated.

Once Promise is installed you need to register the service provider with the application. Open up `config/app.php` and find the `providers` key.

~~~php
'providers' => array(

    'Torann\Promise\PromiseServiceProvider',

)
~~~

### Publish the configurations and migration

Run this on the command line from the root of your project:

~~~
$ php artisan vendor:publish
~~~

A configuration file will be publish to `config/promise.php` and a migration file to `database/migrations/`

## Documentation

[View the official documentation](http://lyften.com/projects/laravel-registry/).

## Change Log

#### v0.2.0

- Upgrade to Laravel 5

#### v0.1.0

- First release
