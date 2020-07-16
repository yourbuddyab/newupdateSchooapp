<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsLign
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
        if(auth()->check() && $request->user()->status == 2){
            Auth::logout();
            return redirect()->route('login')->with('message','Your account is Permanent Delete by School.');
        }elseif (auth()->check() && $request->user()->status == 3) {
            Auth::logout();
            return redirect()->route('login')->with('message', 'Your account is Suspend by School.');
        }
        return $next($request);
    }
}
