<?php namespace Torann\Promise;

use Config;

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
     * @param name The name of the role.
     * @return Role
     */
    public function assignRole( $name )
    {
        $role = \Torann\Promise\Models\Role::whereName($name)->first();

        if ($role == null) throw new ModelNotFoundException;

        return $this->roles()->save($role);
    }

    /**
     * Revoke a role from the user.
     *
     * @param name The name of the role.
     * @return int
     */
    public function revokeRole( $name )
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
    public function hasRole( $name, $ignoreSuperAdmin = false )
    {
        $roles = explode(',', strtolower($name) );

        foreach ($this->roles as $role)
        {
            // Return true for super admin
            if ($ignoreSuperAdmin === false && $role->name === Config::get('promise::super_admin')) {
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
     * @param  string  $permission        Permission string.
     * @param  bool    $ignoreSuperAdmin  Allows for ignoring the super admin setting.
     * @return boolean
     */
    public function can( $name, $ignoreSuperAdmin = false )
    {
        $names = explode(',', strtolower($name) );

        foreach ($this->roles as $role)
        {
            // Return true for super admin
            if ($ignoreSuperAdmin === false && $role->name === Config::get('promise::super_admin')) {
                return true;
            }

            // Check permissionss
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
