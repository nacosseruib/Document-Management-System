<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseParentController;
use App\Models\User;
use App\Models\FolderModel;
use App\Models\AssignFolderModel;
use Illuminate\Http\Request;
use App\Models\UploadFile;
use File;
use Auth;
use DB;


class FolderController extends ParentController
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

        try{
            $data['allFolders'] = FolderModel::join('users', 'users.id', '=', 'folders.userID')
                ->orderBy('folderID', 'Desc')
                ->where('folder_status', 1)
                ->get();
        } catch (\Throwable $errorThrown) {
            $this->storeTryCatchError($errorThrown, 'FolderController@index', 'Error occurred.' );
        }
        return $this->checkViewBeforeRender('home.createFolder.home', $data);
    }

    //List Folder
    public function listFolder()
    {
        $data['showHeaderBanner'] = 0;
        $data['showFooterSlide'] = 0;
        $data['viewPageDetails'] = 1; //0-maintenance | 1-Live
        $data['pageMaintenanceTime'] = '60 + ":" + 60';
        $data['allFolders']  = [];

        try{
            $data['allFolders'] = FolderModel::join('users', 'users.id', '=', 'folders.userID')
                ->orderBy('folderID', 'Desc')
                ->where('folder_status', 1)
                ->get();
        } catch (\Throwable $errorThrown) {
            $this->storeTryCatchError($errorThrown, 'FolderController@listFolder', 'Error occurred.' );
        }
        return $this->checkViewBeforeRender('home.createFolder.listFolder', $data);
    }

    //Save and create Folder Directory
    public function saveAndCreateDirectory(Request $request)
    {
        $is_saved = null;
        $is_created = null;
        $this->validate($request,
        [
            'folderName'     => ['required', 'alpha_num', 'max:100', 'unique:folders,folder_name'],
        ]);
        $folderName = strtolower($request['folderName']);
        try{
            $is_saved = FolderModel::create([
                'folder_name'       => $folderName,
                'userID'            => $this->getUserID(),
            ]);
        } catch (\Throwable $errorThrown) {
            $this->storeTryCatchError($errorThrown, 'FolderController@saveAndCreateDirectory::SaveFolder', 'Error occurred.' );
        }
        if($is_saved)
        {
            //Create Directory
            try{
                $primaryPath = $this->uploadPath() . 'all_folders/';
                if(File::isDirectory($this->uploadPath()))
                {
                    $is_created = File::makeDirectory($primaryPath . $folderName, 0777, true, true);
                    if($is_created)
                    {
                        return redirect()->back()->with('success', 'Folder was created successfully.');
                    }else{
                        $this->deleteFolderFunction($is_saved->folderID); //delete if not created
                    }
                }else{
                    $this->deleteFolderFunction($is_saved->folderID); //delete if not created
                }
            } catch (\Throwable $errorThrown) {
                $this->storeTryCatchError($errorThrown, 'FolderController@saveAndCreateDirectory::CreateFolder', 'Error occurred.' );
            }
            return redirect()->back()->with('danger', 'Sorry, we are unable to created yout folder. Please try again.');
        }else{
            return redirect()->back()->with('danger', 'Sorry, an error occurred when processing your record.');
        }
    }


    //Delete folder
    public function deleteFolder($folderID = null)
    {
        $isDeleted = null;
        if($folderID)
        {
            $isDeleted = $this->deleteFolderFunction($folderID);
            //$isDeleted = FolderModel::where('folderID', $folderID)->update(['folder_status' =>0]);
        }
        if($isDeleted)
        {
            return redirect()->back()->with('success', 'Folder was deleted successfully.');
        }
        return redirect()->back()->with('danger', 'Sorry, we cannot delete this Folder now. Please try again.');
    }


    //Delete folder function
    public function deleteFolderFunction($folderID = null)
    {
        $isDeleted = null;
        if($folderID)
        {
            try{
                $isDeleted = FolderModel::find($folderID)->delete();
            } catch (\Throwable $errorThrown) {
                $this->storeTryCatchError($errorThrown, 'FolderController@deleteFolder', 'Error occurred.' );
            }
        }
        return $isDeleted;
    }


    //Show my folder
    public function userAssignedFolder()
    {
        $data['showHeaderBanner'] = 0;
        $data['showFooterSlide'] = 0;
        $data['viewPageDetails'] = 1; //0-maintenance | 1-Live
        $data['pageMaintenanceTime'] = '60 + ":" + 60';
        $data['myFolders']  = [];

        try{
            $data['myFolders'] = AssignFolderModel::orderBy('assign_folderID', 'Desc')
                ->join('folders', 'folders.folderID', '=', 'assign_folder.forlderID')
                ->join('users', 'users.id', '=', 'assign_folder.userID')
                ->where('assign_folder.userID', $this->getUserID())
                ->where('folders.folder_status', 1)
                ->select('folder_name', 'folderID')
                ->get();
            $data['myFolders'] = FolderModel::where('folders.userID', $this->getUserID())
                ->orderBy('folders.folderID', 'Desc')
                ->get();

        } catch (\Throwable $errorThrown) {
            $this->storeTryCatchError($errorThrown, 'FolderController@userAssignedFolder', 'Error occurred.' );
        }
        return $this->checkViewBeforeRender('home.createFolder.myFolder', $data);
    }



    //Show my file in my folder
    public function userAssignedFolderFile($folderID = null)
    {
        $data['showHeaderBanner'] = 0;
        $data['showFooterSlide'] = 0;
        $data['viewPageDetails'] = 1; //0-maintenance | 1-Live
        $data['pageMaintenanceTime'] = '60 + ":" + 60';
        $data['myFolders']  = [];

        try{
            $data['myFiles'] = UploadFile::orderBy('created_at', 'Desc')
                ->join('folders', 'folders.folderID', '=', 'assign_folder.forlderID')
                //->join('users', 'users.id', '=', 'assign_folder.userID')
                ->where('upload_file.userID', $this->getUserID())
                ->where('upload_file.folderID', $folderID)
                ->where('folders.folder_status', 1)
                ->get();

        } catch (\Throwable $errorThrown) {
            $this->storeTryCatchError($errorThrown, 'FolderController@userAssignedFolderFile', 'Error occurred.' );
        }
        return $this->checkViewBeforeRender('home.createFolder.myFolderFile', $data);
    }


}//end class
