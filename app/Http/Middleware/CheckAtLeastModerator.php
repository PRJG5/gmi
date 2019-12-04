<?php

	namespace App\Http\Middleware;

	use Closure;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Auth;
	use Illuminate\Support\Facades\Response;

	class CheckAtLeastModerator {
		/**
		 * Checks if the user performing the request is a moderator
		 *
		 * @param Request $request the request received
		 * @param Closure $next the next middleware to apply
		 * @return mixed the result of the request
		 */
		public function handle($request, Closure $next) {
			if(Auth::user()->role <= 1) {
				return $next($request);
			} else {
				return Response::json([
					'errors' => [
						'status' => 403,
						'title'  => 'Forbidden',
						'detail' => 'You are not allowed to to this action. You must at least have been granted the moderator role.',
					],
				], 403);
			}
		}

	}
