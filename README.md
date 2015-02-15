# Promise fo Laravel 5

[![Latest Stable Version](https://poser.pugx.org/torann/promise/v/stable.png)](https://packagist.org/packages/torann/promise) [![Total Downloads](https://poser.pugx.org/torann/promise/downloads.png)](https://packagist.org/packages/torann/promise) [![Build Status](https://api.travis-ci.org/Torann/laravel-promise.png)](http://travis-ci.org/Torann/laravel-promise)

Simple Roles and Permissions for Laravel 5.

----------

## Installation

- [Promise on Packagist](https://packagist.org/packages/torann/promise)
- [Promise on GitHub](https://github.com/torann/laravel-promise)
- [Laravel 4 Installation](https://github.com/Torann/laravel-promise/tree/0.1.1)

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

[Homepage](http://lyften.com/projects/laravel-promise/).

### User Model

Next, use the `HasRole` trait in your existing `User` model. For example:

~~~php
<?php namespace App;

use Torann\Promise\HasRole;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {
	
	use Authenticatable, CanResetPassword;

    use HasRole; // Add this trait to your user model
    
...
~~~
    
This will do the trick to enable the relation with `Role` and the following methods within your `User` model:

**roles()** 
Roles assigned to a user

**assignRole(:name)** 
Assign a role to a user

~~~php
$user->assignRole('manager');
~~~

**revokeRole(:name)** 
Revoke a role from the user

~~~php
$user->revokeRole('manager');
~~~

**hasRole(:name)** 
Determine if a user has a given role

~~~php
$user->hasRole('manager');
$user->hasRole('admin,manager,editor'); // Multiple roles
~~~

**can(:name)** 
Check if user has a permission by its name

~~~php
$user->can('edit_posts');
$user->can('edit_posts,edit_comments'); // Multiple permissions
~~~

## Models

You add can Roles and Permissions like any other Model.

~~~php
$role = new Torann\Promise\Models\Role;
$permission = new Torann\Promise\Models\Permission;
~~~

Relationships are handled via the Eloquent ORM:

~~~php
$user->roles()->sync(array(:role_id, :role_id));
$role->permissions()->sync(array(:permission_id, :permission_id));
~~~

## Change Log

#### v0.2.0

- Upgrade to Laravel 5

#### v0.1.0

- First release