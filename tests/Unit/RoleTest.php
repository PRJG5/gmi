<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function changeRole()
    {
        $user = new User();
        $user->name = 'quentin';
        $user->email = 'user@example.com';
        $user->password = '123456789';
        $user->save();

        $this->assertTrue(true);
    }
}
