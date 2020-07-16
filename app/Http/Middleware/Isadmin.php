<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Isadmin
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
        if(auth()->check() && $request->user()->status == 0){
            return $next($request);
        }else{
            Auth::logout();
            return redirect()->route('login')->with('message', 'Something Worng!! Please Login Again and Safely!!');
        }
    }
}
