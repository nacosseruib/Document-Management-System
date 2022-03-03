<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Models\ProductImageModel;
use App\Models\ProductCategoryModel;
use App\Models\User;
use DB;


class ProductController extends ParentController
{

    public function __construct()
    {
        //$this->middleware('auth');
    }


    //Product Details
    public function index($productID = null)
    {
        $data['showHeaderBanner'] = 0;
        $data['showFooterSlide'] = 0;
        $data['showTopSearchBar'] = 1;
        $data['viewPageDetails'] = 1; //0-maintenance | 1-Live
        $data['pageMaintenanceTime'] = '60 + ":" + 60';
        $data['productDetails'] = null;
        $data['productImages']  = [];
        $data['similarAdverts'] = [];
        $getAdvertsImages = [];
        $allproductID = [];

        try{
            $data['path3030'] = $this->downloadPath() . 'products/300x300/';
            $data['path5050'] = $this->downloadPath() . 'products/500x500/';
            $data['largePath'] = $this->downloadPath() . 'products/';
            //Get Product Details
            $data['productDetails'] = ProductModel::join('product_category', 'product_category.categoryID', '=', 'product.categoryID')
                                ->join('users', 'users.id', '=', 'product.userID')
                                ->select('*', 'product.created_at as pcreated')
                                ->where('product.productID', $productID)
                                ->first();

            //Redirect if product not found
            if(!$data['productDetails']){ return redirect()->route('index'); }

            //Get Seller Image
            $sellerImage = User::where('id', $data['productDetails']->userID)->value('user_photo');
            $data['sellerAvater'] = 'profile_images/' . ($sellerImage ? $sellerImage : 'avatar.png');

            //Get Similar Adverts
            if($data['productDetails'])
            {
                $data['similarAdverts'] = ProductModel::join('product_category', 'product_category.categoryID', '=', 'product.categoryID')
                                ->join('users', 'users.id', '=', 'product.userID')
                                ->select('productID', 'product_name', 'display_price', 'category_name', 'total_view', 'product.created_at as pcreated')
                                ->where('product.categoryID', $data['productDetails']->categoryID)
                                ->limit(20)
                                ->get();
            }else{
                $data['similarAdverts'] = ProductModel::join('product_category', 'product_category.categoryID', '=', 'product.categoryID')
                                ->join('users', 'users.id', '=', 'product.userID')
                                ->select('productID', 'product_name', 'display_price', 'category_name', 'total_view', 'product.created_at as pcreated')
                                ->limit(20)
                                ->get();
            }
            //Get Product Images
            foreach($data['similarAdverts'] as $product)
            {
                $getAdvertsImages[$product->productID] = ProductImageModel::where('productID', $product->productID)->value('file_name');
            }
            $data['similarAdvertsImages'] = $getAdvertsImages;
            $data['productImages'] = ProductImageModel::where('productID', $productID)->select('file_name', 'product_imageID')->get();
            //increase view
            try{
                ProductModel::where('productID', $productID)->update(['total_view'=>(DB::raw('total_view + 1'))]);
            }catch(\Throwable $errorThrown){}
        }catch(\Throwable $errorThrown)
        {
            $data['viewPageDetails'] = 0; //0-maintenance | 1-Live
            $this->storeTryCatchError($errorThrown, 'ProductController@index', 'Error occured when trying to view product details.' );
        }
        return $this->checkViewBeforeRender('home.product.productDetails', $data);
    }


    //Product Cart
    public function cart()
    {
        return $this->checkViewBeforeRender('home.product.productCart');
    }



    //List product
    public function listProduct()
    {
        $data['showHeaderBanner'] = 0;
        $data['showFooterSlide'] = 0;
        $data['viewPageDetails'] = 1; //0-maintenance | 1-Live
        $data['pageMaintenanceTime'] = '60 + ":" + 60';
        $data['allProducts'] = [];
        $role = $this->getUserRole();
        try{
            $data['allProducts'] = ProductModel::join('product_category', 'product_category.categoryID', '=', 'product.categoryID')
            ->where('product.is_deleted', 0)
            ->where('product.userID', $this->getUserID())
            ->select('*', 'product.created_at as pcreated')
            ->orderBy('product.created_at', 'Desc')
            ->paginate(30);
        }catch(\Throwable $errorThrown)
        {
            $data['viewPageDetails'] = 0; //0-maintenance | 1-Live
            $this->storeTryCatchError($errorThrown, 'ProductController@listProduct', 'Error occured when trying to create new product.' );
        }
        return $this->checkViewBeforeRender('home.product.listProduct', $data);
    }


    //Delete Product to trash
    public function deleteProductRecycleBin($productID = null)
    {
        $is_deleted = null;
        try{
            $getProductDetails = ProductModel::where('productID', $productID)->first();
            if($getProductDetails)
            {
                $is_deleted = ProductModel::where('productID', $productID)->update([
                    'is_deleted' => 1,
                    'is_online' => 0
                ]);
            }
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'ProductController@deleteProductRecycleBin', 'Error occured when trying to create new product.' );
        }
        if($is_deleted)
        {
            return redirect()->back()->with('success', 'Your record was moved to trash successfully.');
        }
        return redirect()->back()->with('danger', 'Sorry, we cannot move your record to trash now. Try again.');
    }

    //Delete Product Permanently
    public function deleteProductPermanently($productID = null)
    {
        $is_deleted = null;
        try{
            $getProductDetails = ProductModel::where('productID', $productID)->first();
            if($getProductDetails)
            {
                $is_deleted = $getProductDetails->delete();
            }
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'ProductController@deleteProductPermanently', 'Error occured when trying to create new product.' );
        }
        if($is_deleted)
        {
            return redirect()->back()->with('success', 'Your record was deleted successfully.');
        }
        return redirect()->back()->with('danger', 'Sorry, we cannot delete the record now. Try again.');
    }


    //Restore Product from trash
    public function restoreProductFromTrash($productID = null)
    {
        $is_restored = null;
        try{
            $getProductDetails = ProductModel::where('productID', $productID)->first();
            if($getProductDetails)
            {
                $is_restored = ProductModel::where('productID', $productID)->update([
                    'is_deleted' => 0,
                    'is_online' => 1
                ]);
            }
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'ProductController@deleteProductRecycleBin', 'Error occured when trying to create new product.' );
        }
        if($is_restored)
        {
            return redirect()->back()->with('success', 'Your record was restored from trash successfully.');
        }
        return redirect()->back()->with('danger', 'Sorry, we cannot restored your record from trash now. Try again.');
    }


    //List Trashed Product
    public function listTrashedProduct()
    {
        $data['showHeaderBanner'] = 0;
        $data['showFooterSlide'] = 0;
        $data['viewPageDetails'] = 1; //0-maintenance | 1-Live
        $data['pageMaintenanceTime'] = '60 + ":" + 60';
        $data['allProducts'] = [];
        $role = $this->getUserRole();
        try{
            if($role == 1)
            {
                $data['allProducts'] = ProductModel::join('product_category', 'product_category.categoryID', '=', 'product.categoryID')
                                        ->select('*', 'product.created_at as pcreated')
                                        ->where('product.is_deleted', 1)
                                        ->orderBy('product.productID', 'Desc')
                                        ->paginate(30);
            }else{
                $data['allProducts'] = ProductModel::join('product_category', 'product_category.categoryID', '=', 'product.categoryID')
                                        ->where('product.is_deleted', 1)
                                        ->where('product.userID', $this->getUserID())
                                        ->select('*', 'product.created_at as pcreated')
                                        ->orderBy('product.productID', 'Desc')
                                        ->paginate(30);
            }
        }catch(\Throwable $errorThrown)
        {
            $data['viewPageDetails'] = 0; //0-maintenance | 1-Live
            $this->storeTryCatchError($errorThrown, 'ProductController@TrashedProduct', 'Error occured when trying to create new product.' );
        }
        return $this->checkViewBeforeRender('home.product.productTrash', $data);
    }




}//
