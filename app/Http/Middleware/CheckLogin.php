<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if(Auth::user()){
            if (Auth::user()->status){
                return $next($request);
            }
            else{
                return redirect('/login')->with("error_auth", "تم تعطيل حسابك الرجاء مراجعة مسؤول النظام");
            }
        }
        else{
            return redirect('/login')->with("error_auth", "قم بتسجيل الايميل والباسورد للدخول علي النظام");
        }
    }
}
