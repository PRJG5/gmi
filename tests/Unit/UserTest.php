<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Database\QueryException;

class UserTest extends TestCase
{
    use DatabaseTransactions; //Resetting The Database After Each Test

    /** @test */
    public function add_user_ok()
    {
        $user = new User();
        $user->name = 'user';
        $user->email = 'user@example.com';
        $user->password = 'userPassword';
        $user->save();

        $this->assertDatabaseHas('users', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password
        ]);
    }

    /** @test */
    public function add_user_email_already_used()
    {
        $user = new User();
        $user->name = 'user';
        $user->email = 'user@example.com';
        $user->password = 'userPassword';
        $user->save();

        $this->expectException(QueryException::class);
        $user = new User();
        $user->name = 'user2';
        $user->email = 'user@example.com';
        $user->password = 'user2Password';
        $user->save();
    }

    /** @test */
    public function add_user_name_too_short()
    {
        //TODO: Ask user which length
        $user = new User();
        $user->name = '';
        $user->email = 'user@example.com';
        $user->password = 'userPassword';
        $user->save();

        $this->assertDatabaseHas('users', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password
        ]);
    }
}
