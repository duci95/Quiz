<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class AdminMiddleware
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
        if(!$request->session()->has('user'))
            return redirect()->route("log-reg");

        $user = $request->session()->get('user');

        if($user->role_id !== 1) {
            return redirect()->route("log-reg");
        }
        return $next($request);
    }
}
