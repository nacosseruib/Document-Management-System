<?php

namespace App\Library;

use Illuminate\Support\Facades\Throwable;
use File;


class AnyFileUploadClass
{
    protected $file;                    //file: default = null
    protected $maxFileSize;             //int: default = 10
    protected $newExtension;            //string: default = null
    protected $newRadFileName;          //bool: default = true
    protected $uploadCompletePathName;  //string: default = null
    protected $errorFlag;               // 1 => Error occured and 0 => No error

    //Class Contructor
    public function __construct($getFile = null, $getUploadCompletePathName = null, $getMaxFileSize = 10, $getNewExtension = null, $getNewRadFileName = true)
    {
        $this->file = $getFile;
        $this->maxFileSize = $getMaxFileSize;
        $this->newExtension = $getNewExtension;
        $this->newRadFileName = $getNewRadFileName;
        $this->uploadCompletePathName = $getUploadCompletePathName;
    }

    //Do execute process
    public function return()
    {
        return $this->uploadAnyFile();
    }

    private function uploadAnyFile()
    {   $file                   = $this->file;
        $uploadCompletePathName = $this->uploadCompletePathName;
        $maxFileSize            = $this->maxFileSize;
        $newExtension           = $this->newExtension;
        $newRadFileName         = $this->newRadFileName;

        $message        = "Sorry, we are having issue while trying to upload your file!";
        $success        = 0;
        $file_size      = 0.0;
        $newFileName    = null;
        $randomNumber   = rand(11111,99999) . time();
        $errorFlag      = 0;

        if($file){

            try{
                $newExtension = strtolower((!empty($newExtension)) ? $newExtension : ($file->getClientOriginalExtension()));
                $errorFlag = 0;
            } catch (\Throwable  $e) {
                $newExtension = null;
                $errorFlag = 1;
            }

            $extension = $newExtension;
            if(($newExtension <> null) && $errorFlag == 0)
            {
                #code...get file size and file original name
                try{
                    $file_size = number_format(($file->getSize() / 1048576), 2); //in MegaBytes - MB
                    $fileOriginalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                } catch (\Throwable  $e) {
                    $file_size = 10.0; //in MegaBytes - MB
                    $fileOriginalName = $randomNumber; //fallback
                }
                if((($maxFileSize > 0) || ($maxFileSize <> null)) && $errorFlag == 0)
                {
                    #code...check max file size
                    if($file_size <= $maxFileSize)
                    {
                        try{
                            $getFeedBack = $this->fileUploadModule($file, $newExtension, $newRadFileName, $extension, $randomNumber, $fileOriginalName, $uploadCompletePathName);
                            $message = $getFeedBack['message'];
                            $success = $getFeedBack['success'];
                            $newFileName = $getFeedBack['newFileName'];
                        } catch (\Throwable  $e) {
                            $success    = 0;
                        }
                    }else{
                        #Error occurred...
                        $message = "The file size (i.e {$file_size}MB) is bigger than the max. file size allowed (i.e {$maxFileSize}MB).";
                    }
                }else{ #code....do not check file max size
                    #code....check for error(s)
                    try{
                        $getFeedBack = $this->fileUploadModule($file, $newExtension, $newRadFileName, $extension, $randomNumber, $fileOriginalName, $uploadCompletePathName);
                        $message = $getFeedBack['message'];
                        $success = $getFeedBack['success'];
                        $newFileName = $getFeedBack['newFileName'];
                    } catch (\Throwable  $e) {
                        $success    = 0;
                    }
                }
            }else{
                #Error occurred...
                $message = "The file format does not match any of these format: PNG, PDF, DOC, TXT, PPTX, JPE, JPG, JPEG, ETC. !!!";
            }
        }else{
            #Error occurred...
            $message = "No file was selected/attached to be uploaded!";
        }

        //Return Value
        $data['message'] = $message;
        $data['success'] = $success;
        $data['newFileName'] = $newFileName;
        $data['uploadedPath'] = $uploadCompletePathName;

        return $data;
    }//end function


    #uploadImageFile calls this function //Reuseable function
    private function fileUploadModule($file = null, $newExtension = null, $newRadFileName = true, $extension = null, $randomNumber = null, $fileOriginalName = null, $uploadCompletePathName = null)
    {
        //Increase Memory Size
        ini_set('memory_limit', '-1');
        $success = 0;
        $message = null;
        $this->errorFlag = 0;

        #code...//Check New Extension
        if(($newExtension <> null) || ($newExtension <> ""))
        {
            #code...use newly user defined extension
            $fileNewExtension = '.'.$newExtension;
        }else{
            #code....use original file extension
            $fileNewExtension = '.'.$extension;
        }
        #code...Get New file name
        if($newRadFileName == true)
        {
            #code.....use computer random defined file name
            $newFileName = $randomNumber . $fileNewExtension;
        }else{
            #code.....use original file name
            $newFileName = $fileOriginalName . $fileNewExtension;
        }
        #code...start uploading
        if(($uploadCompletePathName <> null) && (File::isDirectory($uploadCompletePathName)))
        {
            #code.... check for any error(s)
            $getReturn = $this->moveFile($file, $uploadCompletePathName, $newFileName);
            $success   = $getReturn['success'];
            $message   = $getReturn['message'];

        }else{
            try{
                File::makeDirectory($uploadCompletePathName . '500x500/', 0777, true, true);
                File::makeDirectory($uploadCompletePathName . '300x300/', 0777, true, true);
                $this->errorFlag = 0;
            } catch (\Throwable  $e) {
                $this->errorFlag = 1;
            }

            if( ($this->errorFlag == 0) && (File::isDirectory($uploadCompletePathName)))
            {
                $getReturn = $this->moveFile($file, $uploadCompletePathName, $newFileName);
                $success   = $getReturn['success'];
                $message   = $getReturn['message'];
            }else{
                 #Error occurred...
                $message = "No path name specified or Path not found(Error while creating path. You can manually create the path)!";
            }

        }
        //Return Value
        $data['message'] = $message;
        $data['success'] = $success;
        $data['newFileName'] = $newFileName;

        return $data;
    }

    //Move file to folder
    private function moveFile($file = null, $uploadCompletePathName = null, $newFileName = null)
    {
        if($file)
            {
                try{
                    #code... start moving file to folder
                    if($file->move($uploadCompletePathName, $newFileName))
                    {
                        $data['message'] = "Your file was successfully uploaded.";
                        $data['success']    = 1;
                    }
                } catch (\Throwable  $e) {
                    $data['success']    = 0;
                    $data['message'] = "Your file cannot be uploaded due to some internal error!";
                }
            }else{
                $data['success']    = 0;
                $data['message'] = "No file to upload! Please select file.";
            }
        return $data;
    }


}
