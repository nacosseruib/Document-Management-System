<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\BaseParentController;
use App\Http\Controllers\RolePermissionController;
use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\User;
use Session;
use Cache;
use Auth;



class LoginController extends BaseParentController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        Cache::flush(); // remove all the cache data
        Session::flush(); // remove all the session data
        $this->middleware('guest')->except('logout');
    }


     //Login Form
     public function createLogin()
     {
        $data['showHeaderBanner'] = 0;
        $data['showFooterSlide'] = 0;
        return $this->checkViewBeforeRender('auth.login', $data);
     }


      //Login
    public function attemptLogin(Request $request)
    {
        $this->validate($request,
        [
            'username'      => 'required|min:5',
            'password'      => 'required|min:8'
        ],['username'       => 'Email/Username']);

        //try{
            $rolePermissionController = new RolePermissionController;
            $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

            if (Auth::attempt([$fieldType => $request->username, 'password' => $request->password, 'status' => 1, 'suspend' => 0])) {
                //try{
                    $rolePermissionController->doAfterLogin();
                    //Update last login
                    $currentLoggedIn = Auth::user()->current_login;
                    User::where('id', Auth::user()->id)->update(['last_login' => $currentLoggedIn, 'current_login' => date('d-m-Y h:i:sa')]);
                //}catch(\Throwable $errorThrown){}
                return redirect()->intended('/');
            }else{
                return redirect()->back()->with('error', 'Email/Username or Password does not correct (or you have not confirmed your email address)')->withInput();
            }
    //     }catch(\Throwable $errorThrown)
    //     {
    //         $this->storeTryCatchError($errorThrown, 'LoginController@attemptLogin', 'Error occured on POST Request when trying to login' );
    //         return redirect()->back()->with('error', 'Sorry, an error occurred while signing in to your account. Try again.')->withInput();
    //     }
    }


}
