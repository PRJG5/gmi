<?php

	namespace App\Http\Middleware;

	use Closure;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Auth;
	use Illuminate\Support\Facades\Response;

	class CheckAtLeastAdministrator {
		/**
		 * Handle an incoming request.
		 *
		 * @param Request $request
		 * @param Closure $next
		 * @return mixed
		 */
		public function handle($request, Closure $next) {
			if(Auth::user()->role <= 0) {
				return $next($request);
			} else {
				return Response::json([
					'errors' => [
						'status' => 403,
						'title'  => 'Forbidden',
						'detail' => 'You are not allowed to to this action. You must at least have been granted the administrator role.',
					],
				], 403);
			}
		}
	}
