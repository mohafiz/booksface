<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user() && Auth::user()->isAdmin() == 1) {
            return $next($request);
        }

        session()->flash('NotAdmin', 'You are not authorized to access this page');
        return redirect('/')->withInput();
    }
}
