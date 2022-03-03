<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GoogleController extends Controller
{
    public function redirectToGoogle()

    {

        return Socialite::driver('google')->redirect();

    }



    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function handleGoogleCallback()

    {

        try {



            $user = Socialite::driver('google')->user();



            $finduser = User::where('google_id', $user->id)->first();



            if($finduser){



                Auth::login($finduser);



                return redirect('/dashboard');



            }else{

                $newUser = User::create([

                    'name' => $user->name,

                    'email' => $user->email,

                    'google_id'=> $user->id,

                    'password' => encrypt('123456dummy')

                ]);

                Auth::login($newUser);
                return redirect('/dashboard');
            }
        } catch (Exception $e) {

            dd($e->getMessage());

        }

    }

}
