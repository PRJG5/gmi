<?php

	namespace App\Http\Controllers\Auth;

	use App\Http\Controllers\Controller;
	use App\Language;
	use App\SpokenLanguages;
	use App\User;
	use Illuminate\Foundation\Auth\RegistersUsers;
	use Illuminate\Http\Response;
	use Illuminate\Support\Facades\Hash;
	use Illuminate\Support\Facades\Validator;

	class RegisterController extends Controller {
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
		public function __construct() {
			$this->middleware('guest');
		}

		/**
		 * Get a validator for an incoming registration data.
		 *
		 * @param array $data
		 * @return Validator
		 */
		protected function validator(array $data) {
			return Validator::make($data,
				[
					'name'      => [
						'required',
						'string',
						'max:255',
					],
					'email'     => [
						'required',
						'string',
						'email',
						'max:255',
						'unique:users',
					],
					'password'  => [
						'required',
						'string',
						'min:8',
						'confirmed',
					],
					'languages' => [
						'required',
					],
				]);
		}

		/**
		 * Create a new user instance after a valid registration. Add spoken languages.
		 * If an error occurs, rollback.
		 *
		 * @param array $data
		 * @return User or nothing if error
		 */
		protected function create(array $data) {
			$data = (object) $data;
			$user = new User([
				'name'     => $data->name,
				'email'    => $data->email,
				'password' => Hash::make($data->password),
			]);
			$user->save();

			foreach($data->languages as $lang) {
				$spokenLanguage = new SpokenLanguages([
					'user_id'      => $user->id,
					'language_ISO' => $lang,
				]);
				$spokenLanguage->save();
			}

			return $user;
		}

		/**
		 * Show the application registration form.
		 *
		 * @return Response
		 */
		public function showRegistrationForm() {
			return view('auth.register',
				[
					'languages' => Language::all(),
				]);
		}
	}
