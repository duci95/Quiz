<?php

namespace App\Http\Middleware;

use App\Model\User;
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

        if(session()->has('user')){
            if(session()->get('user')->role_id !== 1){
                if(session()->get('user')->role_id === 3)
                    User::find(session()->get('user')->id)->update(['is_blocked' => 1]);
                return redirect()->back();
            }
            redirect()->back();
            return $next($request);
        }
        return redirect()->route('log-reg');
    }
}
