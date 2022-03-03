<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use response;

class PreventBackHistory 
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
          $response = $next($request);
          
          if (!Auth::check()) {
              return redirect()->route('login');
          }

          $response->headers->set('Access-Control-Allow-Origin' , '*');
          $response->headers->set('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE');
          $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Accept, Authorization, X-Requested-With, Application');

          $headers = [
                    'Cache-Control' => 'nocache, no-store, max-age=0, must-revalidate',
                    'Pragma','no-cache',
                    'Expires', 'Sun, 02 Jan 1990 00:00:00 GMT',
                ];
                
          foreach($headers as $key => $value) 
          {
              $response->headers->set($key, $value);
          }
          //
          return $response;
        
      }



}//end class
