<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Login as user.
     * 
     * @param $user [User/null]
     * @return App\User
     */
    protected function signIn($user = null) 
    {
        $user = $user ?: create('App\User', ['role' => 0]);

        $this->actingAs($user);

        return $user;
    }

    /**
     * Login as admin
     * 
     * @param $user [User/null]
     * @return App\User
     */
    protected function signInAdmin($admin = null) 
    {
        $admin = $admin ?: create('App\User', ['role' => 1]);

        $this->actingAs($admin);

        return $admin;
    }
}
