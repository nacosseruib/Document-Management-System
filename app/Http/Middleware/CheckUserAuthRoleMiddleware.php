<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use response;

class CheckUserAuthRoleMiddleware
{

      public function handle($request, Closure $next)
      {
              /*if (!$request->secure()) {
                  return redirect()->secure($request->getRequestUri());
              }

              return $next($request); */
            if(!Auth::check()){

               return redirect()->route('login')->with('danger', 'Session expired! You need to login now.');
            }

            return $next($request);

      }





}//end class
