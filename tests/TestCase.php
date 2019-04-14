<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Create an user and authenticate him
     *
     * @param User|null $user
     * @return User|mixed
     */
    protected function authenticate(User $user = null)
    {
        if(! $user) $user = factory(User::class)->create();

        $this->actingAs($user);

        return $user;
    }
}
