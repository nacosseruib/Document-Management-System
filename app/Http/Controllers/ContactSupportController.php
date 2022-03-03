<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\ProductModel;
use App\Models\ProductImageModel;
use App\Models\ProductCategoryModel;
use DB;


class ContactSupportController extends ParentController
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
        $data['viewPageDetails'] = 1; //0-maintenance | 1-Live
        $data['pageMaintenanceTime'] = '60 + ":" + 60';
        $data['allProducts']        = [];
        $getAdvertsImages           = [];
        $data['advertsImages']      = [];

    try{
            $data['path3030'] = $this->downloadPath() . 'products/300x300/';
            $data['path5050'] = $this->downloadPath() . 'products/500x500/';
            $data['largePath'] = $this->downloadPath() . 'products/';
            //Get all product
            $data['allProducts'] =  ProductModel::where('product.admin_status', 1)->where('product.is_deleted', 0)->where('product.is_online', 1)
                ->join('product_category', 'product_category.categoryID', '=', 'product.categoryID')
                ->join('users', 'users.id', '=', 'product.userID')
                ->select('product.productID', 'product.product_name', 'product.original_price', 'product_category.category_name', 'product.created_at as pcreated')
                ->orderBy('product.productID', 'Desc')
                ->limit(50)
                ->get();
            foreach($data['allProducts'] as $product)
            {
                $getAdvertsImages[$product->productID] = ProductImageModel::where('productID', $product->productID)->value('file_name');
            }
            $data['advertsImages'] = $getAdvertsImages;
        }catch(\Throwable $errorThrown)
        {
            $this->storeTryCatchError($errorThrown, 'IndexController@index', 'Error occured when trying to get all product.' );
        }

        return $this->checkViewBeforeRender('home.contactSupport.home', $data);
    }
}
