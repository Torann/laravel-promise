<?php namespace Torann\Promise;

use Config;
use Illuminate\Database\Eloquent\ModelNotFoundException;

trait HasRole
{
    /**
     * Get the roles for the user.
     *
     * @return mixed
     */
    public function roles()
    {
        return $this->belongsToMany(
            'Torann\Promise\Models\Role',
            'role_user'
        )->withTimestamps();
    }

    /**
     * Assign a user to a given role.
     *
     * @param  string $name The name of the role.
     *
     * @return \Torann\Promise\Models\Role
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function assignRole($name)
    {
        $role = \Torann\Promise\Models\Role::whereName($name)->first();

        if ($role == null) throw new ModelNotFoundException;

        return $this->roles()->save($role);
    }

    /**
     * Revoke a role from the user.
     *
     * @param  string $name The name of the role.
     *
     * @return int
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function revokeRole($name)
    {
        $role = \Torann\Promise\Models\Role::whereName($name)->first();

        if ($role == null) throw new ModelNotFoundException;

        return $this->roles()->detach($role);
    }

    /**
     * Determine if a user has a given role.
     *
     * @param  string  $name              The name of the role.
     * @param  bool    $ignoreSuperAdmin  Allows for ignoring the super admin setting.
     * @return bool
     */
    public function hasRole($name, $ignoreSuperAdmin = false)
    {
        $roles = explode(',', strtolower($name) );

        foreach ($this->roles as $role)
        {
            // Return true for super admin
            if ($ignoreSuperAdmin === false && $role->name === Config::get('promise.super_admin')) {
                return true;
            }

            if(in_array($role->name, $roles))
            {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if user has a permission by its name
     *
     * @param  string  $name              Permission string.
     * @param  bool    $ignoreSuperAdmin  Allows for ignoring the super admin setting.
     * @return boolean
     */
    public function can($name, $ignoreSuperAdmin = false)
    {
        $names = explode(',', strtolower($name) );

        foreach ($this->roles as $role)
        {
            // Return true for super admin
            if ($ignoreSuperAdmin === false && $role->name === Config::get('promise.super_admin')) {
                return true;
            }

            // Check permissions
            foreach ($role->permissions as $permission)
            {
                if (in_array($permission->name, $names)) {
                    return true;
                }
            }
        }

        return false;
    }

}
