<?php

namespace App\Http\Controllers\Auth;

use App\Language;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\SpokenLanguages;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'languages' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration. Add spoken languages.
     * If an error occurs, rollback.
     *
     * @param  array  $data
     * @return \App\User or nothing if error
     */
    protected function create(array $data)
    {
        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $userDB = User::where('email', $data['email'])->first();

        try {
            DB::beginTransaction();
            $cpt = 0;
            do {
                $spokenLanguage = new SpokenLanguages();
                $spokenLanguage->user_id = $userDB->id;
                $spokenLanguage->languageISO = $data['languages'][$cpt];
                $success = $spokenLanguage->save();
                $cpt++;
            } while ($success && $cpt < count($data['languages']));
            if (!$success) {
                DB::rollback();
            } else {
                DB::commit();
            }
        } catch (\Exception $e) {
            DB::rollback();
        }
        return $user;
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $languages = Language::orderBy('content')->get();
        return view('auth.register', compact('languages'));
    }
}
