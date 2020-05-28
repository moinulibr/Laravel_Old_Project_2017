<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Route;
use Closure;
use Illuminate\Support\Facades\Auth;

class UserRoleRouteCheckMiddleware
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
        if(MENU_PERMISSION(Route::currentRouteName()) || MENU_PERMISSION($request->path()))
        {
           return  $next($request);
        }else{
            return abort('404');
            #return redirect()->route('home')->with('error','You are not permitted to access! Please contract with Admin!');
            return redirect()->back()->with('error','You are not permitted to access! Please contract with Admin!');
        }
    }
}
