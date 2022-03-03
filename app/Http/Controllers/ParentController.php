<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\AnyFileUploadClass;
use App\Library\RandomAlphaNumericClass;
use App\Models\ErrorCaughtModel;
use App\Models\User;
use Session;
use Cache;
use Image;
use Auth;
use View;
use DB;

class ParentController extends BaseParentController
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->getAllModel();
    }

    // all model
    public function getAllModel()
    {
        $this->productModel                 = new ErrorCaughtModel;
        $this->user                         = new User;

        return;
    }

    //Return Integer - Cache Time - 30Mininutes
    public function appCacheTime($getTime = 1)
    {
        return $getTime;
    }

    //Return String - Get User ID that logs in
    public function getUserID()
    {
        return (Auth::check() ? Auth::user()->id : null);
    }

    //Get User Role
    public function getUserRole()
    {
        return (Auth::check() ? Auth::user()->user_role : null);
    }

    //Return String - Get User Token that logs in
    public function getUserToken()
    {
         return (Auth::check() ? Auth::user()->user_token : null);
    }

    //Return Array of String/Numeric - Reuseable Image File Upload Module
    public function uploadAnyFile($file = null, $uploadCompletePathName = null, $maxFileSize = 10, $newExtension = null, $newRadFileName = true)
    {
         $data = new AnyFileUploadClass($file, $uploadCompletePathName, $maxFileSize, $newExtension, $newRadFileName);
         return $data->return();
     }//end function


     //Return String - Upload Path
     public function uploadPath()
     {
        return $this->getUploadPath = env('UPLOADPATHROOT', null);
     }

    //Return String - Download Path
    public function downloadPath()
    {
        return $this->getDownloadPath = env('DOWNLOADPATHROOT', null);
    }


    //Return Nothing : Void - Create Image Thumbnail after upload the image to a path
    public function createThumbnail($pathSource = null, $pathDestination = null, $width = 300, $height = 300, $is_resize_canvas = 0)
    {
        //Resize Image
        $resizeImageWidth    = ($width ? $width - ($width/4) : 0);
        $resizeImageHeight   = ($height ? $height - ($height/4) : 0);
        //Resize Canvas
        $resizeCanvasWidth    = ($is_resize_canvas == 1 ? $width : 0);
        $resizeCanvasHeight   = ($is_resize_canvas == 1 ? $height : 0);
        if($pathDestination != null)
        {
            try{
                //copy file
                ($pathSource ? copy($pathSource, $pathDestination) : null);

                //Resize Image with canvas
                $img = Image::make($pathDestination)->resize($resizeImageWidth,  $resizeImageHeight, function ($constraint) {
                    $constraint->aspectRatio();
                })->resizeCanvas($resizeCanvasWidth, $resizeCanvasHeight, 'center', false, '#ffffff');

                $img->save($pathDestination);

            }catch(\Throwable $errorThrown){
                $this->storeTryCatchError($errorThrown, 'ParentController@createThumbnail', 'Error occured when trying to create image thumbnail' );
            }
        }
        return;
    }


    //Return Numeric Value - Remove comma from string
    public function removeCommaFromString($getString = null)
    {
        $numericString = 0;
        try{
            if($getString != null || $getString != 0)
            {
                $stringWithNoComma = str_replace( ',', '', $getString );

                if( is_numeric( $stringWithNoComma) ) {
                    $numericString = $stringWithNoComma;
                }else{
                    $numericString = (int)$stringWithNoComma;
                }
            }else{
                $numericString = $getString;
            }
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'ParentController@removeCommaFromString', 'Error occured when trying to remove comma from string' );
        }
        return $numericString;
    }





}//end class
