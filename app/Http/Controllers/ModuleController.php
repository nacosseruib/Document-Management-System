<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Carbon\Carbon;
use App\Models\Module;
use App\Models\SubModule;
use App\Models\AssignSubmoduleRole;
use Auth;
use Schema;
use Session;
use DB;

class ModuleController extends RolePermissionController
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    //create
    public function createRouteModule()
    {
        $data['showHeaderBanner']       = 0;
        $data['showFooterSlide']        = 0;
        $data['showTopSearchBar']       = 0;
        $data['viewPageDetails']        = 1; //0-maintenance | 1-Live
        $data['pageMaintenanceTime']    = '60 + ":" + 60';

        $data['allModule'] = Module::orderBy('module_rank', 'Asc')->get();
        //Get Edit Data
        (Session::get('editModule') ? $data['editModule'] = Session::get('editModule') : '');

        return view('ModuleSubModule.RouteModule', $data);
    }


    public function saveModule(Request $request)
    {
        $this->validate($request, [
            'routeName'         => 'required|regex:/^[a-zA-Z0-9,.!?\-)\( ]*$/|max:100',
            //'routeUrl'        => 'required|string',
            'routStatus'        => 'required',
        ]);
        $routeUrl           = trim($request['routeUrl']);
        $moduleID           = trim($request['editModuleID']);
        $moduleName         = trim($request['routeName']);
        $moduleStatus       = trim($request['routStatus']);
        $moduleRank         = trim($request['routeRank']);
        $moduleIcon      = trim($request['moduleIcon']);
        $url                = (($routeUrl <> '#' or $routeUrl <> null) ? (ltrim(rtrim($routeUrl, "/"),  "/")) : '#');
        $message = 'Sorry we cannot add/update your record now. Please try again !';
        $success = null;
        if(Module::find($moduleID)){
            //Update
            $module = Module::find($moduleID);
            $module->module_name    = $moduleName;
            $module->module_url     = $url;
            $module->module_rank    = $moduleRank;
            $module->module_active  = $moduleStatus;
            $module->module_icon    = $moduleIcon;
            $module->updated_at     = date('Y-m-d');
            $success = $module->save();
            Session::forget('editModule');
            $message = 'Your record was updated successfully.';
        }else{
            $this->validate($request, [
                'routeName'         => 'required|regex:/^[a-zA-Z0-9,.!?\-)\( ]*$/|max:1000|unique:module,module_name',
            ]);
            //Insert
            $module = New Module;
            $module->module_name    = $moduleName;
            $module->module_url     = $url;
            $module->module_rank    = $moduleRank;
            $module->module_active  = $moduleStatus;
            $module->module_icon    = $moduleIcon;
            $module->updated_at     = date('Y-m-d');
            $success = $module->save();
            Session::forget('editModule');
            $message = 'Your record was added successfully.';
        }
        //
        if($success)
        {
            try{
                $this->doAfterLogin();
            }catch(\Throwable $e){}
            return redirect()->route('createModule')->with('message', $message);
        }else{
            return redirect()->route('createModule')->with('error', $message);
        }

    }//


    // Remove Module
    public function removeModule($moduleID)
    {
        $success = 0;
        if(Module::find($moduleID) and (!SubModule::where('moduleID',$moduleID)->first()) and  (!AssignSubmoduleRole::where('moduleID',$moduleID)->first())){
            $success = Module::where('moduleID', $moduleID)->delete();
        }
        if($success){
            try{
                $this->doAfterLogin();
            }catch(\Throwable $e){}
            return redirect()->route('createModule')->with('message', 'Your record was deleted successfully.');
        }
        return redirect()->route('createModule')->with('error', 'Sorry, we cannot delete this record is already in use. Try again.');

    }

    // show edit data
    public function editModule($moduleID)
    {
        if(Module::find($moduleID)){
            Session::put('editModule', Module::find($moduleID));
        }else{
            Session::forget('editModule');
        }
        return redirect()->route('createModule');

    }

    // cancel edit
    public function cancelEditModule()
    {
        Session::forget('editModule');

        return redirect()->route('createModule')->with('message', 'Edit was canceled. You can now add new recored.');
    }


}
