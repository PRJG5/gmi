<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\User;
use App\SpeakedLanguage;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Database\QueryException;

class SpeakedLanguageTest extends TestCase
{
    use DatabaseTransactions; //Resetting The Database After Each Test

    /** @test */
    public function add_user_one_lang_ok()
    {
        $user = new User();
        $user->name = 'user';
        $user->email = 'user@example.com';
        $user->password = 'userPassword';
        $user->save();

        $userDB = User::where('email', $user->email)->first();

        $speackedLanguage = new SpeakedLanguage();
        $speackedLanguage->user_id = $userDB->id;
        $speackedLanguage->languageISO = 'SPA';
        $speackedLanguage->save();

        $this->assertDatabaseHas('speaked_languages', [
            'user_id' => $speackedLanguage->user_id,
            'languageISO' => $speackedLanguage->languageISO
        ]);
    }

    /** @test */
    public function add_user_with_two_lang_ok()
    {
        
        $user = new User();
        $user->name = 'user';
        $user->email = 'user@example.com';
        $user->password = 'userPassword';
        $user->save();

        $userDB = User::where('email', $user->email)->first();

        $speackedLanguage = new SpeakedLanguage();
        $speackedLanguage->user_id = $userDB->id;
        $speackedLanguage->languageISO = 'SPA';
        $speackedLanguage->save();
        $speackedLanguage2 = new SpeakedLanguage();
        $speackedLanguage2->user_id = $userDB->id;
        $speackedLanguage2->languageISO = 'SPA';
        $speackedLanguage2->save();

        $this->assertDatabaseHas('speaked_languages', [
            'user_id' => $speackedLanguage->user_id,
            'languageISO' => $speackedLanguage->languageISO
        ]);
        $this->assertDatabaseHas('speaked_languages', [
            'user_id' => $speackedLanguage2->user_id,
            'languageISO' => $speackedLanguage2->languageISO
        ]);
    }

    /** @test */
    public function add_user_with_two_same_lang()
    {
        $user = new User();
        $user->name = 'user';
        $user->email = 'user@example.com';
        $user->password = 'userPassword';
        $user->save();

        $userDB = User::where('email', $user->email)->first();

        $this->expectException(QueryException::class);
        $speackedLanguage = new SpeakedLanguage();
        $speackedLanguage->user_id = $userDB->id;
        $speackedLanguage->languageISO = 'SPA';
        $speackedLanguage->save();
        $speackedLanguage->save();
    }
}
