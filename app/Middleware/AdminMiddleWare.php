<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;



class AdminMiddleWare
{
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()){
            if(Auth::user()->isAdmin == '1'){
                return $next($request);
            }else{
                return redirect('/viewuser');
            }
        }else{
            return redirect('/login');
        }
    }
}
