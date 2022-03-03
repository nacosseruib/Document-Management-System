<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseParentController;
use App\Models\User;
use App\Models\DealershipRequestModel;
use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\ContactUsModel;
use Auth;
use DB;


class DashboardController extends ParentController
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
        $data['getNewUser'] = null;
        $data['isDealerRequestApproved'] = null;

        try{
            $data['getNewUser'] = User::where('status', 0)->limit(10)->get();
            $data['dealershipRequest'] = DealershipRequestModel::where('is_approved', 0)->limit(10)->get();
            $data['isDealerRequestApproved'] = DealershipRequestModel::where('userID', $this->getUserID())->value('is_approved');
            $data['totalDealerRequestPending'] = DealershipRequestModel::where('is_approved', 0)->count();
            $data['totalUser'] = User::count();
            $data['totalContactUs'] = ContactUsModel::count();

        } catch (\Throwable $errorThrown) {
            $this->storeTryCatchError($errorThrown, 'DashboardController@index', 'Error occurred when fetching data.' );
        }
        return $this->checkViewBeforeRender('home.dashboard.adminDashboard', $data);
    }


}//end class
