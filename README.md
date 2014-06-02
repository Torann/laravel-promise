# Promise fo Laravel 4 - Alpha

[![Latest Stable Version](https://poser.pugx.org/torann/promise/v/stable.png)](https://packagist.org/packages/torann/promise) [![Total Downloads](https://poser.pugx.org/torann/promise/downloads.png)](https://packagist.org/packages/torann/promise) [![Build Status](https://api.travis-ci.org/Torann/laravel-promise.png)](http://travis-ci.org/Torann/laravel-promise)

Simple Roles and Permissions for Laravel 4.

----------

## Installation

- [Promise on Packagist](https://packagist.org/packages/torann/promise)
- [Promise on GitHub](https://github.com/torann/laravel-promise)

To get the latest version of Promise simply require it in your `composer.json` file.

~~~
"torann/promise": "dev-master"
~~~

You'll then need to run `composer install` to download it and have the autoloader updated.

Once Promise is installed you need to register the service provider with the application. Open up `app/config/app.php` and find the `providers` key.

~~~php
'providers' => array(

    'Torann\Promise\PromiseServiceProvider',

)
~~~

### Publish the config

Run this on the command line from the root of your project:

	$ php artisan config:publish torann/promise

This will publish Promise's config to ``app/config/packages/torann/promise/``.

### Migration

Now migrate the database tables for Promise. Run this on the command line from the root of your project:

	$ php artisan migrate --package=torann/promise

### User Model

Next, use the `HasRole` trait in your existing `User` model. For example:

~~~php
<?php

use Torann\Promise\HasRole;

class User extends Eloquent {

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

#### v0.1.0

- First release