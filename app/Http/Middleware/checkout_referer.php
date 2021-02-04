<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkout_referer
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
        $referer = $request->header('referer');

        if ($referer === url('/cart')) {
            return $next($request);
        }
        return back();
    }
}
