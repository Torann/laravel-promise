<?php namespace Torann\Promise\Models;

class Permission extends \Eloquent
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'permissions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('name', 'description');

    /**
     * Roles
     *
     * @return object
     */
    public function roles()
    {
        return $this->belongsToMany(
            'Torann\Promise\Models\Role',
            'permission_role'
        )->withTimestamps();
    }
}
