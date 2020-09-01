<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class Harisauth
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
         if(Session::get('isLogin') != 1){
            return redirect('/login');
        }else{
            return $next($request);
        }
        
    }
}