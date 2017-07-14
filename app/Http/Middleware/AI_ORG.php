<?php

namespace App\Http\Middleware;
use Auth;
use Session;
use Closure;

class AI_ORG
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
        if (!Auth::guest() && Auth::user()->access != 2) {
            return redirect('/');
        }else if(Auth::guest()){
            return redirect('/login');
        } else if(!Auth::guest() && Auth::user()->access == 2){
            return $next($request);
        } 

        return $next($request);
    }
}

