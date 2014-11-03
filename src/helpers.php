<?php

if (! function_exists('canUser'))
{
    /**
     * Current user permissions helper.
     *
     * @param  string $permission
     * @return bool
     */
    function canUser($permission)
    {
        $user = Auth::user();
        return ($user && $user->can($permission));
    }
}

if (! function_exists('isCurrentUser'))
{
    /**
     * Current user role helper.
     *
     * @param  string $role
     * @param  bool $ignoreSuperAdmin
     * @return bool
     */
    function isCurrentUser($role, $ignoreSuperAdmin = false)
    {
        $user = Auth::user();
        return ($user && $user->hasRole($role, $ignoreSuperAdmin));
    }
}
