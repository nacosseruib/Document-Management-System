<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactUsModel;

class ContactUsController extends BaseParentController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['showHeaderBanner'] = 0;
        $data['showFooterSlide'] = 0;
        $data['viewPageDetails'] = 1; //0-maintenance | 1-Live
        $data['pageMaintenanceTime'] = '60 + ":" + 60';


        return $this->checkViewBeforeRender('contactUs.home', $data);
    }

    public function save(Request $request)
    {
        $is_save = null;
        $this->validate($request,
        [
            'firstName'     => 'required|max:150|string',
            //'lastName'      => 'required|max:150|string',
            'email'         => 'required|max:150|email',
            'message'       => 'required|max:10000|string',
        ]);
        try{
            $is_save = ContactUsModel::create([
                'first_name'    => $request['firstName'],
                'last_name'     => $request['lastName'],
                'email'         => $request['email'],
                'message'       => $request['message'],
            ]);
        }catch(\Throwable $errorThrown)
        {
            $this->storeTryCatchError($errorThrown, 'ContactUsController@save', 'Error occured on POST Request when trying to save contact us.' );
        }
        if($is_save)
        {
            return redirect()->back()->with('success', 'Your message was sent successfully. We will get back to you.');
        }
        return redirect()->back()->with('danger', 'Sorry, we can process your information. Please try again. Thank you.');
    }


    //List Contact us message
    public function listContactUs()
    {
        $data['showHeaderBanner'] = 0;
        $data['showFooterSlide'] = 0;
        $data['viewPageDetails'] = 1; //0-maintenance | 1-Live
        $data['pageMaintenanceTime'] = '60 + ":" + 60';
        $data['getData'] = [];
        try{
            $data['getData'] = ContactUsModel::orderBy('contactusID', 'Desc')->paginate(30);
        }catch(\Throwable $errorThrown){
            $data['viewPageDetails'] = 0; //0-maintenance | 1-Live
            $this->storeTryCatchError($errorThrown, 'ContactUsController@listContactUs', 'Error occured when trying to list contact us.' );
        }
        return $this->checkViewBeforeRender('home.contactus.home', $data);
    }

    //delete message
    public function deleteContactUs($contactID = null)
    {
        $is_deleted = null;
        try{
            $contactInfo = ContactUsModel::find($contactID);
            if($contactInfo)
            {
                $is_deleted = $contactInfo->delete();
            }
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'ContactUsController@deleteContactUs', 'Error occured when trying to delete contact record.' );
        }
        if($is_deleted)
        {
            return redirect()->back()->with('success', 'Your record was deleted successfully.');
        }
        return redirect()->back()->with('danger', 'Sorry, we cannot delete your record now. Try again.');
    }


}
