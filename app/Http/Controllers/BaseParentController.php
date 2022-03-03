<?php

namespace App\Http\Controllers;
use App\Models\ErrorCaughtModel;
use App\Library\RandomAlphaNumericClass;
use View;
use DB;

class BaseParentController extends Controller
{

    public function __construct()
    {

    }


    //Return Integer - Cache Time - 30Mininutes
    public function appCacheTime($getTime = 1)
    {
        return $getTime;
    }


    //Return View - Check view if exist before rendering the view blade
    public function checkViewBeforeRender($getView = null, $data1 = [], $data2 = [], $data3 = [], $data4 = [], $data5 = [])
    {
        if($getView <> null)
        {
            try{
                return (View::exists($getView) ? view($getView, $data1, $data2, $data3, $data4, $data5) : redirect()->route('index'));
            }catch(\Throwable $errorThrown)
            {
                $this->storeTryCatchError($errorThrown, 'BaseParentController@checkViewBeforeRender', 'Error occured when trying to check if view/blade exist before rendering the view/blade.' );
                return redirect()->route('index');
            }
        }else{
            return redirect()->route('index');
        }
    }

    //Return No Value : Void - Store any error that occurred in try-catch block
    public function storeTryCatchError($getError = null, $getFunctionModuleName = null, $errorDescription = null )
    {
        try{
            return ErrorCaughtModel::create([
                'throwable_error'       => ($getError <> null ? $getError : 'No error occured'),
                'function_module_name'  => $getFunctionModuleName,
                'error_description'     => $errorDescription,
                'created_at'            => date('Y-m-d h:i:sa'),
                'updated_at'            => date('Y-m-d h:i:sa')
            ]);
        }catch(\Throwable $errorThrown){}
    }


    //Return String - Reuseable Random AlphaNumeric  Module
    public function generateRandomAlphaNumeric($getLength = 10)
    {
         $data = new RandomAlphaNumericClass($getLength);
         return $data->return();
     }//end function


}//end class
