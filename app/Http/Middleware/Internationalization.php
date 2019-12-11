<?php

namespace App\Http\Middleware;

use Closure;
use App;
use \Illuminate\Http\Request;

class Internationalization
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
		App::setLocale($request->cookie('lang') ?: 'en');
		return $next($request);
    }
}
