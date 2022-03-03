<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\Role;
use App\Models\ProductImageModel;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use DB;


class NewUserAccountController extends ParentController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Create User
    public function index()
    {
        $data['showHeaderBanner']   = 0;
        $data['showFooterSlide']    = 0;
        $data['showTopSearchBar']   = 0;
        $data['viewPageDetails']    = 1; //0-maintenance | 1-Live
        $data['pageMaintenanceTime'] = '60 + ":" + 60';
        $data['allProducts']        = [];
        $getAdvertsImages           = [];
        $data['advertsImages']      = [];

        try{

        }catch(\Throwable $errorThrown)
        {
            $this->storeTryCatchError($errorThrown, 'NewUserAccountController@index', 'Error occured when trying to get all product.' );
        }
        return $this->checkViewBeforeRender('home.newUserAccount.home', $data);
    }


    //Save User - Create New Account
    public function saveUser(Request $request)
    {
        $data['showHeaderBanner']   = 0;
        $data['showFooterSlide']    = 0;
        $data['showTopSearchBar']   = 0;
        $data['viewPageDetails']    = 1; //0-maintenance | 1-Live
        $data['pageMaintenanceTime'] = '60 + ":" + 60';

        $is_saved = null;
         $this->validate($request,
         [
            'email'         => ['required', 'email', 'max:200', 'unique:users'],
            'password'      => ['required', 'string', 'min:8', 'confirmed'],
            'firstName'     => ['required', 'string', 'min:3', 'max:100'],
            'lastName'      => ['required', 'string', 'min:3', 'max:100'],
            'phoneNumber'   => ['required', 'string', 'max:15'],
         ]);
         try{
            $is_saved = User::create([
                'first_name'    => $request['firstName'],
                'last_name'     => $request['lastName'],
                'phone_number'  => $request['phoneNumber'],
                'email'         => $request['email'],
                'password'      => Hash::make($request['password']),
                'user_token'    => $this->generateRandomAlphaNumeric(36),
                'last_login'    => date('d-m-Y h:i:sa'),
                'current_login' => date('d-m-Y h:i:sa'),
                'seller_id'     => 'ESG00' . (User::count() + 1),
                'user_role'     => $request['userRole']
            ]);
            if($is_saved)
            {
                return redirect()->route('listUser')->with('success', 'Your record was saved successfully.');
            }else{
                return redirect()->back()->with('danger', 'Sorry, an error occurred when processing your record.');
            }
         }catch(\Throwable $errorThrown){
             $this->storeTryCatchError($errorThrown, 'NewUserAccountController@saveUser', 'Error occured when adding new user.' );
         }
         return redirect()->back()->with('danger', 'Sorry, we cannot create new user now. Try again later');
    }


    //List User
    public function listUser()
    {
        $data['showHeaderBanner']       = 0;
        $data['showFooterSlide']        = 0;
        $data['showTopSearchBar']       = 0;
        $data['viewPageDetails']        = 1; //0-maintenance | 1-Live
        $data['pageMaintenanceTime']    = '60 + ":" + 60';
        $data['getNewUser']             = [];
        $data['userRole']           = [];
         try{
            $data['getNewUser'] = User::orderBy('users.created_at', 'Desc')
            ->leftjoin('role', 'role.roleID', '=', 'users.user_role')
            ->where('users.user_role', '<>', 1)
            ->select('*', 'users.created_at as user_created_at')
            ->paginate(50);
            $data['userRole'] = Role::where('role_active', 1)->get();
         }catch(\Throwable $errorThrown){
             $this->storeTryCatchError($errorThrown, 'NewUserAccountController@listUser', 'Error occured when loading user' );
         }
         return $this->checkViewBeforeRender('home.newUserAccount.listUser', $data);
    }


    //Update User Status
    public function updateUserStatus(Request $request)
    {
        $is_saved = null;
        $this->validate($request,
        [
            'confirmEmail'      => ['required', 'max:100'],
            'userSuspension'    => ['required', 'max:100'],
            'firstName'         => ['required', 'max:100'],
            'emailAddress'      => ['required', 'email', 'max:100'],
        ]);
        try{
            $userID = $request['userName'];
            if($userID)
            {
                if($request['password'])
                {
                    $this->validate($request,
                    [
                        'password'      => ['required', 'string', 'min:8', 'confirmed'],
                    ]);
                    $is_saved = User::where('id', $userID)->update([
                        'status'        => $request['confirmEmail'],
                        'suspend'       => $request['userSuspension'],
                        'user_role'     => $request['role'],
                        'first_name'    => $request['firstName'],
                        'last_name'     => $request['lastName'],
                        'phone_number'  => $request['phoneNumber'],
                        'email'         => $request['emailAddress'],
                        'password'      => Hash::make($request['password']),
                    ]);
                }else{
                    $is_saved = User::where('id', $userID)->update([
                        'status'        => $request['confirmEmail'],
                        'suspend'       => $request['userSuspension'],
                        'user_role'     => $request['role'],
                        'first_name'    => $request['firstName'],
                        'last_name'     => $request['lastName'],
                        'phone_number'  => $request['phoneNumber'],
                        'email'         => $request['emailAddress']
                    ]);
                }

            }
            if($is_saved)
            {
                return redirect()->route('listUser')->with('success', 'Your record was saved successfully.');
            }else{
                return redirect()->back()->with('danger', 'Sorry, an error occurred when processing your record.');
            }
         }catch(\Throwable $errorThrown){
             $this->storeTryCatchError($errorThrown, 'NewUserAccountController@updateUserStatus', 'Error occured when adding new user.' );
         }
         return redirect()->back()->with('danger', 'Sorry, we cannot update your record now. Try again later');
    }

}//end class
