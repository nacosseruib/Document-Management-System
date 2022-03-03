<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseParentController;
use App\Models\User;
use App\Models\FolderModel;
use Illuminate\Http\Request;
use App\Models\AssignFolderModel;
use File;
use Auth;
use DB;


class AssignFolderController extends ParentController
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $data['showHeaderBanner'] = 0;
        $data['showFooterSlide'] = 0;
        $data['viewPageDetails'] = 1; //0-maintenance | 1-Live
        $data['pageMaintenanceTime'] = '60 + ":" + 60';
        $data['allFolders']  = [];
        $data['allUsers']  = [];
        $data['assignFolders'] = null;

        try{
            $data['allFolders'] = FolderModel::orderBy('folderID', 'Desc')->where('folder_status', 1)->get();
            $data['allUsers'] = User::orderBy('id', 'Desc')->where('user_role', '<>', 1)->get();
            $data['assignFolders'] = AssignFolderModel::orderBy('assign_folderID', 'Desc')
            ->join('folders', 'folders.folderID', '=', 'assign_folder.forlderID')
            ->join('users', 'users.id', '=', 'assign_folder.userID')
            ->get();
        } catch (\Throwable $errorThrown) {
            $this->storeTryCatchError($errorThrown, 'AssignFolderController@index', 'Error occurred.' );
        }
        return $this->checkViewBeforeRender('home.assignFolder.home', $data);
    }


    //Save and create Folder Directory
    public function saveAssignFolderToUser(Request $request)
    {
        $is_saved = null;
        $is_created = null;
        $this->validate($request,
        [
            'folderName'     => ['required', 'numeric'],
            'userName'       => ['required', 'string'],
        ]);
        $folderName = strtolower($request['folderName']);
        try{
            $is_saved = AssignFolderModel::updateOrCreate(
            [
                'forlderID'       => $request['folderName'],
                'userID'          => $request['userName'],
            ],
            []);
        } catch (\Throwable $errorThrown) {
            $this->storeTryCatchError($errorThrown, 'AssignFolderController@saveAssignFolderToUser', 'Error occurred.' );
        }
        if($is_saved)
        {
            return redirect()->back()->with('message', 'You record was saved successfully.');
        }else{
            return redirect()->back()->with('danger', 'Sorry, an error occurred when processing your record.');
        }
    }


    //Delete folder
    public function deleteAssignFolder($assignFolderID = null)
    {
        $isDeleted = null;
        if($assignFolderID)
        {
            $isDeleted = (AssignFolderModel::find($assignFolderID) ? AssignFolderModel::find($assignFolderID)->delete() : null);
            //$isDeleted = FolderModel::where('folderID', $folderID)->update(['folder_status' =>0]);
        }
        if($isDeleted)
        {
            return redirect()->back()->with('success', 'Your record was deleted successfully.');
        }
        return redirect()->back()->with('danger', 'Sorry, we cannot delete this record now. Please try again.');
    }



}//end class
