<?php namespace Torann\Promise\Models;

class Role extends \Eloquent
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('name', 'description', 'level');

    /**
     * Users
     *
     * @return object
     */
    public function users()
    {
        return $this->belongsToMany(
            'Torann\Promise\Models\User',
            'role_user'
        )->withTimestamps();
    }

    /**
     * Permissions
     *
     * @return object
     */
    public function permissions()
    {
        return $this->belongsToMany(
            'Torann\Promise\Models\Permission',
            'permission_role'
        )->withTimestamps();
    }

    /**
     * Does the role have a specific permission
     *
     * @param  array|string $permissions Single permission or an array of permissions
     *
     * @return boolean
     */
    public function has($permissions)
    {
        $permissions = !is_array($permissions)
            ? array($permissions)
            : $permissions;

        $valid = false;

        foreach (static::permissions()->get() as $permission)
        {
            foreach ($permissions as $perm_to_check)
            {
                if($permission->name == $perm_to_check)
                {
                    $valid = true;
                    break 1;
                }
            }
        }

        return $valid;
    }
}