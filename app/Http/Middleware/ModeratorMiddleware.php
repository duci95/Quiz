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
        $user = $request->session()->get('user');

        if($user->role_id !== 2) {
            return redirect()->back();
        }
        return $next($request);
    }
}
