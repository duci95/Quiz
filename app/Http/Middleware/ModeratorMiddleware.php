<?php

namespace App\Http\Middleware;

use Closure;

class ModeratorMiddleware
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
        if(!$request->session()->has('user')){
            return redirect()->route("log-reg");
        }
        $user = $request->session()->get('user');

        if($user->role_id !== 2) {
            return redirect()->route("log-reg");
        }
        return $next($request);
    }
}
