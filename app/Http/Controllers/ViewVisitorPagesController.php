<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\PageContentModel;
use App\Models\PageModel;


class ViewVisitorPagesController extends BaseParentController
{
    public function __construct()
    {

    }

    public function index($pageRoute = null)
    {
        $data['showHeaderBanner'] = 0;
        $data['showFooterSlide'] = 1;
        $data['aboutUs'] = null;
        $data['viewPageDetails'] = 1; //0-maintenance | 1-Live
        $data['pageMaintenanceTime'] = '72 + ":" + 60';
        $data['pageDetails'] = null;

        try{
            $getPageID = PageModel::where('route', $pageRoute)->value('pageID');
            if($getPageID)
            {
                $data['pageDetails'] = PageContentModel::where('pageID', $getPageID)->where('page_status', 1)->first();
            }
            //record is empty
            if(!$data['pageDetails']){
                $data['viewPageDetails'] = 0; //0-maintenance | 1-Live
            }
            $data['aboutUs'] = null;
        }catch(\Throwable $errorThrown){
            $data['viewPageDetails'] = 0; //0-maintenance | 1-Live
            $this->storeTryCatchError($errorThrown, 'AboutUsController@index', 'Error occured when trying to create page' );
        }
        return $this->checkViewBeforeRender('viewVisitorPages.home', $data);
    }

}//
