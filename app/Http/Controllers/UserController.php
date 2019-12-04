<?php

	namespace App\Http\Controllers;

use App\Enums\Roles;
use App\User;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Auth;

	class UserController extends Controller {

		public function manageRoles() {
			return view('administration.manageRoles')->with([
				'users' => User::all(),
				'roles' => Roles::getValues(),
			]);
		}

		public function updateRole(Request $request) {
			$user = User::find($request->userId);
			// Auth user cannot be accessed from the API
			// need to setup and use Passport
			if(Auth::user()->role > 0) { // has to be admin
				return response()->json([
					'errors' => [
						'status' => 403,
						'title'  => 'Forbidden',
						'detail' => 'You don\'t have permission to do that.',
					],
				], 403);
			} else if(Auth::user() == $user) { // cannot edit himself
				return response()->json([
					'errors' => [
						'status' => 403,
						'title'  => 'Conflict',
						'detail' => 'You don\'t have permission to do that.',
					],
				], 409);
			} else {
				$user->role = $request->role;
				$user->save();
				return response()->json([
					'data' => [
						'status' => 200,
						'title'  => 'OK',
						'detail' => 'Role has been updated.',
					],
				], 200);
			}
		}

	}
