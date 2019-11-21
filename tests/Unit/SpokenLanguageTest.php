<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use App\User;
use App\SpokenLanguages;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Database\QueryException;

class SpokenLanguageTest extends TestCase
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

        $userDB = DB::table('users')->where('email', $user->email)->first();

        $spokenLanguage = new SpokenLanguages();
        $spokenLanguage->user_id = $userDB->id;
        $spokenLanguage->languageISO = 'SPA';
        $spokenLanguage->save();

        $this->assertDatabaseHas('spoken_languages', [
            'user_id' => $spokenLanguage->user_id,
            'languageISO' => $spokenLanguage->languageISO
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

        $userDB = DB::table('users')->where('email', $user->email)->first();

        $spokenLanguage = new SpokenLanguages();
        $spokenLanguage->user_id = $userDB->id;
        $spokenLanguage->languageISO = 'SPA';
        $spokenLanguage->save();
        $spokenLanguage2 = new SpokenLanguages();
        $spokenLanguage2->user_id = $userDB->id;
        $spokenLanguage2->languageISO = 'FRA';
        $spokenLanguage2->save();

        $this->assertDatabaseHas('spoken_languages', [
            'user_id' => $spokenLanguage->user_id,
            'languageISO' => $spokenLanguage->languageISO
        ]);
        $this->assertDatabaseHas('spoken_languages', [
            'user_id' => $spokenLanguage2->user_id,
            'languageISO' => $spokenLanguage2->languageISO
        ]);
    }

    /** @test */
    public function add_two_users_with_same_lang(){
        $user = new User();
        $user->name = 'user';
        $user->email = 'user@example.com';
        $user->password = 'userPassword';
        $user->save();

        $user2 = new User();
        $user2->name = 'nico';
        $user2->email = 'user2@example.com';
        $user2->password = 'userPassword';
        $user2->save();

        $userDB = DB::table('users')->where('email', $user->email)->first();
        $userDB2 = DB::table('users')->where('email', $user2->email)->first();

        $spokenLanguage = new SpokenLanguages();
        $spokenLanguage->user_id = $userDB->id;
        $spokenLanguage->languageISO = 'SPA';
        $spokenLanguage->save();
        $spokenLanguage = new SpokenLanguages();
        $spokenLanguage->user_id = $userDB2->id;
        $spokenLanguage->languageISO = 'SPA';
        $spokenLanguage->save();

        $this->assertDatabaseHas('spoken_languages', [
            'user_id' => $userDB->id,
            'languageISO' => $spokenLanguage->languageISO
        ]);

        $this->assertDatabaseHas('spoken_languages', [
            'user_id' => $userDB2->id,
            'languageISO' => $spokenLanguage->languageISO
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

        $userDB = DB::table('users')->where('email', $user->email)->first();

        $this->expectException(QueryException::class);
        $spokenLanguage = new SpokenLanguages();
        $spokenLanguage->user_id = $userDB->id;
        $spokenLanguage->languageISO = 'SPA';
        $spokenLanguage->save();
        $spokenLanguage = new SpokenLanguages();
        $spokenLanguage->user_id = $userDB->id;
        $spokenLanguage->languageISO = 'SPA';
        $spokenLanguage->save();
    }
}
