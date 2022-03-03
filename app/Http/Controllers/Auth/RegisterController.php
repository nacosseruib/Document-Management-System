<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\BaseParentController;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Livewire\Component;



class RegisterController extends BaseParentController
{

    use RegistersUsers;
    protected $redirectTo = RouteServiceProvider::HOME;
    // public $email = "ajax livewire";
    // public $password;
    // public $password_confirmation;
    // public $firstName;
    // public $lastName;
    // public $phoneNumber;
    // public $termsAndCondition;

    public function __construct()
    {
        $this->middleware('guest');
    }

    //CREATE NEW REGISTRATION
    public function createRegistration()
    {
        return redirect()->route('index');
    }


    public function saveRegistration(Request $request)
    {
        $is_save = null;
        $this->validate($request, [
            'email' => ['required', 'email', 'max:200', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'firstName' => ['required', 'string', 'min:3', 'max:100'],
            'lastName' => ['required', 'string', 'min:3', 'max:100'],
            //'phoneNumber' => ['required', 'string', 'max:15'],
		]);
        try {
            $is_save = User::create([
                'first_name'    => $request['firstName'],
                'last_name'     => $request['lastName'],
                'phone_number'  => $request['phoneNumber'],
                'email'         => $request['email'],
                'password'      => Hash::make($request['password']),
                'user_token'    => $this->generateRandomAlphaNumeric(36),
                'last_login'    => date('d-m-Y h:i:sa'),
                'current_login' => date('d-m-Y h:i:sa'),
                'seller_id'     => 'ESG00' . (User::count() + 1)
            ]);
            if($is_save)
            {
                //Send Welcome Email
                #code......
                return redirect()->route('registerCompleted')
                ->with('message', 'Congratulations! Your registration was successful.')
                ->with('status', 1);
            }else{
                return redirect()->route('registerCompleted')
                ->with('danger', 'Sorry, we encountered error when trying to complete your registration. Please try again.')
                ->with('status', 0);
            }
        } catch (\Throwable $errorThrown) {
            $this->storeTryCatchError($errorThrown, 'saveRegistration', 'Error occured on Get Request when create user registration page' );
        }
        return redirect()->route('registerCompleted')->with('status', 0);
    }

    //Registration Complete
    public function registrationCompleted()
    {
        $data['showHeaderBanner'] = 0;
        $data['showFooterSlide'] = 0;
        return view('auth.registrationComplete', $data);
    }


    //Send Email Address
    public function sendAccountRegistrationWelcomeEmail($userID = null, $emailAddress = null)
    {
        try{
             $userDetails = UserProfileModel::where($this->user->getTable().'.id', $userID)
                 ->join($this->user->getTable(), $this->user->getTable().'.id', '=', $this->userProfileModel->getTable().'.userID')
                 ->first();
             if($userDetails)
             {
                 $emailData = ([
                     'name'=> $userDetails->first_name .' '. $userDetails->last_name,
                     'email'=> $userDetails->email
                 ]);
                 ($userDetails->email ? Mail::to($userDetails->email)->send(new sendEmailAccountRegistration($emailData)) : '');
             }
        } catch (\Exception $errorThrown) {
             $this->storeTryCatchError($errorThrown, 'RegisterController@sendAccountRegistrationWelcomeEmail', 'Error occured When try to send Welcome Registration Account.' );
        }

        return;
    }


}//end class
