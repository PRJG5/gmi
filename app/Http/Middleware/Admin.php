<?php

namespace App\Http\Middleware;

use App\Enums\Roles;
use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user()->role == Roles::ADMIN){
            return $next($request);
        }
        return redirect('home')->with('error','You have not admin access');
    }
}
