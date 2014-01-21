<?php

use Torann\Promise\HasRole;
use Mockery as m;

class HasRoleTest extends PHPUnit_Framework_TestCase {

    public function tearDown()
    {
        m::close();
    }

    public function testHasRole()
    {
        $model = new TestingModel;

        $this->assertTrue( $model->hasRole( 'admina' ) );
        $this->assertTrue( $model->hasRole( 'adminb' ) );
        $this->assertFalse( $model->hasRole( 'adminc' ) );
    }

    public function testCan()
    {
        $model = new TestingModel;

        $this->assertTrue( $model->can( 'manage_a' ) );
        $this->assertTrue( $model->can( 'manage_b' ) );
        $this->assertFalse( $model->can( 'manage_d' ) );
    }
}

class Config
{
    static public function get($key = '') {
        return false;
    }
}

class TestingModel
{
    use HasRole;

    public $roles = array();
    public $permissions = array();

    function __construct()
    {
        // Simulates Eloquent's relation access
        $role_a = m::mock('Role');
        $role_a->name = "admina";

        $role_b = m::mock('Role');
        $role_b->name = "adminb";

        $this->roles = array($role_a, $role_b);

        // Simulates Eloquent's relation access
        $permission_a = m::mock('Permission');
        $permission_a->name = "manage_a";
        $permission_a->description = "User can manage a";

        $permission_b = m::mock('Permission');
        $permission_b->name = "manage_b";
        $permission_b->description = "User can manage b";

        $this->permissions = array($permission_a, $permission_b);

        $role_a->permissions = $this->permissions;
        $role_b->permissions = $this->permissions;
    }

    // Because this method is called by the trait
    public function belongsToMany($model, $table) {}
}
