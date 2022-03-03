<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\ProductModel;
use App\Models\ProductImageModel;
use App\Models\ProductCategoryModel;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Auth;
use DB;


class ProfileController extends ParentController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['showHeaderBanner']   = 0;
        $data['showFooterSlide']    = 0;
        $data['showTopSearchBar']   = 0;
        $data['viewPageDetails']    = 1; //0-maintenance | 1-Live
        $data['pageMaintenanceTime'] = '60 + ":" + 60';

    try{
        $data['getUser'] = User::where('id', $this->getUserID())->first();
    }catch(\Throwable $errorThrown){
        $this->storeTryCatchError($errorThrown, 'ProfileController@index', 'Error occured when trying to load user profile.' );
    }

        return $this->checkViewBeforeRender('home.profile.home', $data);
    }


    //Upload profile Image
    public function UpdateProfileImage(Request $request)
    {
        $is_saved = null;
        $uploadCompletePathName = $this->uploadPath() . 'profile_images/';
        $uploadCompletePathNameThumbnail300X300 = $uploadCompletePathName . '300x300/';
        $uploadCompletePathNameThumbnail500X500 = $uploadCompletePathName . '500x500/';

        $this->validate($request,
        [
            'profileImage'    => ['required'],
            'profileImage'    => ['image', 'mimes:png,jpg,jpe,jpeg,gif', 'max: 2100']
        ]);
        try{
                if($request->hasFile('profileImage'))
                {
                    $getArrayResponse = $this->uploadAnyFile($request['profileImage'], $uploadCompletePathName, $maxFileSize = 10, $newExtension = null, $newRadFileName = true);
                    if($getArrayResponse)
                    {
                        if($getArrayResponse['success'])
                        {
                            $is_saved = User::where('id', $this->getUserID())->update([
                                'user_photo'         => $getArrayResponse['newFileName'],
                            ]);
                        }
                        //Resize Product Thumbnail - 300X300
                        $this->createThumbnail($uploadCompletePathName . $getArrayResponse['newFileName'], $uploadCompletePathNameThumbnail300X300 . $getArrayResponse['newFileName'], $width = 300, $height = 300);
                        //Resize Product Thumbnail - 500X500
                        $this->createThumbnail($uploadCompletePathName . $getArrayResponse['newFileName'], $uploadCompletePathNameThumbnail500X500 . $getArrayResponse['newFileName'], $width = 500, $height = 500, $is_resize_canvas = 1);
                    }
                }

                return redirect()->back()->with('success', 'Your record was updated successfully');

        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'ProfileController@UpdateProfileImage', 'Error occured when uploading profile image.' );
        }
        return redirect()->back()->with('danger', 'Sorry, we cannot upload your record now. Try again later');
    }


     //Update profile details
     public function updateProfileDetails(Request $request)
     {
         $is_saved = null;
         $this->validate($request,
         [
            //'email' => ['required', 'email', 'max:200', 'unique:users'],
            'firstName' => ['required', 'string', 'min:3', 'max:100'],
            'lastName' => ['required', 'string', 'min:3', 'max:100'],
            'phoneNumber' => ['required', 'string', 'max:15'],
         ]);
         try{
            $is_saved = User::where('id', $this->getUserID())->update([
                'first_name'    => $request['firstName'],
                'last_name'     => $request['lastName'],
                'phone_number'  => $request['phoneNumber'],
                'email'         => $request['email'],
            ]);
            return redirect()->back()->with('success', 'Your record was updated successfully.');
         }catch(\Throwable $errorThrown){
             $this->storeTryCatchError($errorThrown, 'ProfileController@updateProfileDetails', 'Error occured when uploading profile image.' );
         }
         return redirect()->back()->with('danger', 'Sorry, we cannot update your record now. Try again later');
     }

     //Update profile details
     public function updateProfileSecurity(Request $request)
     {
         $is_saved = null;
         $this->validate($request,
         [
            'currentPassword'   => ['required', 'string', 'min:8'],
            'password'          => ['required', 'string', 'min:8', 'confirmed'],
         ],['password'=>'New Password']);
         try{
            $userCurrentPassword = (Auth::check() ? Auth::user()->password : null);
             //avoid user entering the same password
            if(Hash::check($request['password'], $userCurrentPassword))
            {
                return redirect()->back()->with('danger', 'Sorry, you cannot enter the same password as your current password!');
            }
            //change password
            if($userCurrentPassword && Hash::check($request['currentPassword'], $userCurrentPassword))
            {
                $is_saved = User::where('id', $this->getUserID())->update([
                    'password' => Hash::make($request['password']),
                ]);
                if($is_saved)
                {
                    return redirect()->back()->with('success', 'Your record was updated successfully.');
                }
            }else{
                return redirect()->back()->with('danger', 'Sorry, your have entered wrong current password!');
            }
         }catch(\Throwable $errorThrown){
             $this->storeTryCatchError($errorThrown, 'ProfileController@updateProfileSecurity', 'Error occured when uploading profile image.' );
         }
         return redirect()->back()->with('danger', 'Sorry, we cannot update your record now. Try again later');
     }



}//end class
