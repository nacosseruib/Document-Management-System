<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use response;

class HttpsProtocol  
{
  
      public function handle($request, Closure $next)
      {
              /*if (!$request->secure()) {
                  return redirect()->secure($request->getRequestUri());
              }
              
              return $next($request); */
              
            if(config('app.env') == 'production'){

                $host = $request->header('host');
                if (substr($host, 0, 4) != 'www.') {
                    if(!$request->secure()){
                        $request->server->set('HTTPS', true);
                    }
                    $request->headers->set('host', 'www.'.$host);
                    return Redirect($request->path(),301);
                }else{
                    if(!$request->secure()){
                        $request->server->set('HTTPS', true);
                        return Redirect($request->path(),301);
                    }
                }
            }
    
            return $next($request);

      }
    
  



}//end class
