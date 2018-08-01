<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Actived
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
        if(Auth::check() && Auth::user()->activated){
            return $next($request);
        }

        Auth::logout();

        return redirect()
        ->route('login')
        ->withErrors([
            'email' => ['Only activated user can access area!'],
        ]);
    }
}
