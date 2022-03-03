<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseParentController;
use App\Models\User;
use App\Models\PageContentModel;
use App\Models\PageModel;
use Illuminate\Http\Request;
use Livewire\Component;
use Session;
use Auth;



class PageContentController extends ParentController
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
        $data['pageDetails'] = null;
        $data['pageID'] = Session::get('pageID');

        try{
            $data['pages'] = PageModel::all();
            if($data['pageID'])
            {
                $data['pageDetails'] = PageContentModel::join('page', 'page.pageID', '=', 'page_content.pageID')
                                        ->where('page.status', 1)
                                        ->where('page_content.pageID', $data['pageID'])
                                        ->first();
            }
        }catch(\Throwable $errorThrown){
            $data['viewPageDetails'] = 0;
            $this->storeTryCatchError($errorThrown, 'PageContentController@index', 'Error occured when trying create page' );
        }
        return $this->checkViewBeforeRender('home.page-content.home', $data);
    }

    //Save or update page content
    public function save(Request $request)
    {
        $is_saved = null;
        $validated = $request->validate([
            'pageName'      => 'required|numeric',
            'pageStatus'    => 'required|numeric',
            'pageTitle'     => 'required|string',
            'pageContent'   => 'required',
        ]);
        try{
            $is_saved = PageContentModel::updateOrCreate([
                'pageID'        => $request->get('pageName'),
            ],[
                'userID'        => Auth::user()->id,
                'title'         => $request->get('pageTitle'),
                'content'       => $request->get("pageContent"),
                'page_status'   => $request->get('pageStatus'),
            ]);
        }catch(\Throwable $errorThrown){
            $data['viewPageDetails'] = 0;
            $this->storeTryCatchError($errorThrown, 'PageContentController@index', 'Error occured when trying create page' );
        }
        if($is_saved)
        {
            return redirect()->back()->with('success', 'Your information was update successfully.');
        }
        return redirect()->back()->with('danger', 'Sorry, we are having issue when updating your information. Please try again. Thanks.');
    }


    //get page ID and content
    public function getPageContentByPageID(Request $request)
    {
        Session::forget('pageID');
        Session::put('pageID', $request['pageName']);

        return redirect()->back();
    }


}//end class
