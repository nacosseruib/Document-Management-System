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

class SubModuleController extends RolePermissionController
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    //create
    public function createRouteSubModule()
    {
        $data['showHeaderBanner']       = 0;
        $data['showFooterSlide']        = 0;
        $data['showTopSearchBar']       = 0;
        $data['viewPageDetails']        = 1; //0-maintenance | 1-Live
        $data['pageMaintenanceTime']    = '60 + ":" + 60';

        $data['allSubModule'] = array();
        $data['allModuleLoop'] = array();
        $allSubModules = array();

        $data['allModule'] = Module::orderBy('module_name', 'Asc')->orderBy('module_rank', 'Asc')->get();
        $getAllModules = Module::orderBy('module_name', 'Asc')->orderBy('module_rank', 'Asc')->get();

        ($getAllModules ? $data['allModuleLoop'] = $getAllModules : $data['allModuleLoop'] = []);
        if($getAllModules)
        {
            foreach($getAllModules as $moduleKey=>$listModule)
            {
                $allSubModules[$moduleKey] = SubModule::where('submodule.moduleID', $listModule->moduleID)
                ->orderBy('module.module_name', 'Asc')
                ->orderBy('submodule.submodule_rank', 'Asc')
                ->leftjoin('module', 'module.moduleID', '=', 'submodule.moduleID')
                ->select('*', 'module.moduleID as moduleID', 'submodule.moduleID as moduleIDSub')
                ->get();
            }
        }
        $data['allSubModule'] = $allSubModules;
        //Get Edit Data
        (Session::get('editSubModule') ? $data['editSubModule'] = Session::get('editSubModule') : '');
        return view('ModuleSubModule.RouteSubModule', $data);
    }


    public function saveSubModule(Request $request)
    {
        $this->validate($request, [
            'moduleName'        => 'required|numeric',
            'routeName'         => 'required|string|max:100', //'required|regex:/^[a-zA-Z0-9,.!?\-)\( ]*$/|max:100',
            'routeUrl'          => 'required|string',
            'routStatus'        => 'required',
            //'submodulePageActive' => 'required',
        ]);
        $subModuleID            = trim($request['editSubModuleID']);
        $moduleName             = trim($request['moduleName']);
        $subModuleName          = trim($request['routeName']);
        $subModuleRank          = trim($request['routeRank']);
        $subModuleStatus        = trim($request['routStatus']);
        $submodulePageActive    = trim($request['submodulePageActive']);
        $submoduleIcon          = trim($request['submoduleIcon']);
        $routeUrl               = trim($request['routeUrl']);
        $url                    = (($routeUrl <> '#' or $routeUrl <> null) ? (ltrim(rtrim($routeUrl, "/"),  "/")) : '#');
        $message = 'Sorry we cannot add/update your record now. Please try again !';
        $success = null;
        if(SubModule::find($subModuleID)){
            //Update
            $module = SubModule::find($subModuleID);
            $module->moduleID           = $moduleName;
            $module->submodule_name     = $subModuleName;
            $module->submodule_url      = $url;
            $module->submodule_rank     = $subModuleRank;
            $module->submodule_active   = $subModuleStatus;
            $module->submodule_active_page = $submodulePageActive;
            $module->submodule_icon     = $submoduleIcon;
            $module->submodule_updated_at     = date('Y-m-d');
            $success = $module->save();
            Session::forget('editSubModule');
            $message = 'Your record was updated successfully.';
        }else{
            $this->validate($request, [
                'routeName'         => 'required|string|max:1000|unique:submodule,submodule_name', //'regex:/^[a-zA-Z0-9,.!?\-)\( ]*$/'
            ]);
            //Insert
            $module = New SubModule;
            $module->moduleID           = $moduleName;
            $module->submodule_name     = $subModuleName;
            $module->submodule_url      = $url;
            $module->submodule_rank     = $subModuleRank;
            $module->submodule_active   = $subModuleStatus;
            $module->submodule_active_page = $submodulePageActive;
            $module->submodule_icon     = $submoduleIcon;
            $module->submodule_updated_at     = date('Y-m-d');
            $success = $module->save();
            Session::forget('editSubModule');
            $message = 'Your record was added successfully.';
        }
        //
        if($success)
        {
            try{
                $this->doAfterLogin();
            }catch(\Throwable $e){}
            return redirect()->route('createSubModule')->with('message', $message);
        }else{
            return redirect()->route('createSubModule')->with('error', $message);
        }

    }//


    // Remove SubModule
    public function removeSubModule($subModuleID)
    {
        $success = 0;
        if(SubModule::find($subModuleID) and (!AssignSubmoduleRole::where('submoduleID', $subModuleID)->first())  ){
            $success = SubModule::where('subModuleID', $subModuleID)->delete();
        }
        if($success){
            try{
                $this->doAfterLogin();
            }catch(\Throwable $e){}
            return redirect()->route('createSubModule')->with('message', 'Your record was deleted successfully.');
        }
        return redirect()->route('createSubModule')->with('error', 'Sorry, we cannot delete this record is already in use. Try again.');

    }

    // show edit data
    public function editSubModule($subModuleID)
    {
        if(SubModule::find($subModuleID)){
            $getOneSubModule = SubModule::orderBy('submodule.submodule_rank', 'Asc')
                ->join('module', 'module.moduleID', '=', 'submodule.moduleID')
                ->where('submodule.submoduleID', $subModuleID)
                ->first();
            Session::put('editSubModule', $getOneSubModule);
        }else{
            Session::forget('editSubModule');
        }
        return redirect()->route('createSubModule');
    }

    // cancel edit
    public function cancelEditSubModule()
    {
        Session::forget('editSubModule');

        return redirect()->route('createSubModule')->with('message', 'Edit was canceled. You can now add new recored.');
    }


}
