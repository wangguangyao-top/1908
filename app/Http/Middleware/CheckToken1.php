<?php

namespace App\Http\Middleware;

use Closure;

class CheckToken1
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
         session(['login'=>'王光耀']);
         $request->session()->save();
        $data=session('login');
        if(!$data){
            return redirect('/logon1');
        }
        return $next($request);
    }
}
