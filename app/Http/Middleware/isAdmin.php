<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->roles){
            foreach(auth()->user()->roles as $role){
                if($role->name == 'Admin'){
                    return $next($request);
                }
            }
        }
        return redirect()->route('user.home');
    }
}
