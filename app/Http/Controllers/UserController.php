<?php

	namespace App\Http\Controllers;

	use App\User;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Auth;

	class UserController extends Controller {
		/**
		 * Create a new controller instance.
		 *
		 * @return void
		 */
		public function __construct() {

		}

		public function allUsers() {
			return view('administration.allUsers')->with(['users' => User::all()]);
		}

		public function updateRole(Request $request) {
			if(Auth::id() == $request->userId) {
				return [
					'status'  => 'ERROR',
					'type'    => 'Permission non accordée',
					'message' => 'Vous ne pouvez pas modifier vos propres droits',
				];
			} else {
				$user = User::find($request->userId);
				$user->role = $request->role;
				$user->save();
				return [
					'status'  => 'SUCCESS',
					'type'    => '',
					'message' => '',
				];
			}
		}

	}
