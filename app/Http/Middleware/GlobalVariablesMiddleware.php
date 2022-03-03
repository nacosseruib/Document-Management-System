<?php

namespace App\Http\Middleware;

use Closure;
use response;
use App\Http\Controllers\ParentController;
use App\Models\User;
use App\Models\UserTypeModel;
use App\Models\UserProfileModel;
use App\Models\CategoryModel;
use App\Models\CollectionModel;
use App\Models\DeliveryAgentModel;
use Cache;
use Auth;
use DB;
use view;



class GlobalVariablesMiddleware
{

    public function handle($request, Closure $next)
    {
        $globalVariable['userAvatar']      = null;
        $globalVariable['dashboardName']   = 'Dashboard';
        $globalVariable['user_role']       = null;

        $parentController = new ParentController;
        try{
            $globalVariable['userAvatar']           = (Auth::user()->user_photo ? $parentController->downloadPath() . 'profile_images/' . Auth::user()->user_photo :  $parentController->downloadPath() . 'profile_images/avatar.png');
            if(Auth::check()){
                $globalVariable['dashboardName']    = DB::table('user_type')->where('user_typeID', Auth::user()->user_role)->value('user_type_name');
                $globalVariable['user_role']        = Auth::user()->user_role;
            }
        } catch (\Throwable  $errorThrown) {}




        //abort(403);
        view()->share($globalVariable);
        return $next($request);
    }
}
