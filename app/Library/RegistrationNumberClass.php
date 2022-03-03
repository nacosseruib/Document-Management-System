<?php

namespace App\Library;

use Illuminate\Support\Facades\Throwable;
use Illuminate\Support\Facades\Request;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Foundation\Bus\DispatchesJobs;
use DB;



class RegistrationNumberClass
{
    //Class Properties
    protected $abbreviation1;
    protected $abbreviation2;
    protected $abbreviation3;
    protected $separator;
    protected $startFrom;
    protected $autoIncrement;
    protected $random;
    protected $numericOnly;
    protected $alphaNumericOnly;
    protected $letterOnly;
    protected $resutlFormat;
    protected $tableNameRegNum;
    protected $errorFlag;  // 1 => Error occured and 0 => No error
    protected $regID = "regID";
    protected $total_user = "total_user";
    protected $regNumCreated = "registration_number";
    protected $start_auto = "start_auto";
    protected $date = "date";
    protected $length;
    protected $zeroPrefix = "000000000000000000000000000000000000000000000000000000000000";
    protected $numberGenerated;


    //Class Contructor
    public function __construct($getAbbreviation1 = null, $getAbbreviation2 = null, $getAbbreviation3 = null, $getSeparator = "/", $getStartFrom = 1, $getAutoIncrement = true, $getRandom = false, $getNumericOnly = false, $getAlphaNumericOnly = false, $getLetterOnly = false, $getResutlFormat = 0, $getTableNameRegNum = "track_registration_number", $regNumLength = 5)
    {
        $this->abbreviation1     = $getAbbreviation1;   //string: default = null
        $this->abbreviation2     = $getAbbreviation2;   //string: default = null
        $this->abbreviation3     = $getAbbreviation3;   //string: default = null
        $this->separator         = $getSeparator;        //string: default = "/"
        $this->startFrom         = (int)(($getStartFrom < 1) ? 1 : $getStartFrom); //int: default = 1
        $this->autoIncrement     = $getAutoIncrement;    //bool:  default = true
        $this->random            = $getRandom;           //bool: default = false
        $this->numericOnly       = $getNumericOnly;      //bool: default = false
        $this->alphaNumericOnly  = $getAlphaNumericOnly; //bool: default = false
        $this->letterOnly        = $getLetterOnly;       //bool: default = false
        $this->resutlFormat      = $getResutlFormat;     //int: default = 0
        $this->tableNameRegNum   = ($getTableNameRegNum == null ? "track_registration_number" : $getTableNameRegNum);  //string: default = track_registration_number
        $this->length            = (int)(($regNumLength < 1) ? 5 : $regNumLength);   //int: default = 5
    }

    //Do execute process
    public function return()
    {
        return $this->registrationNumber();
    }


    //Student Registration Number
    private function registrationNumber()
    {
        //create Tracking Table
        try{
            $this->createTableAutoincrement();
        } catch (\Throwable  $e) {}

        try{
            $getLastIDInserted = $this->setLastRegistrationNumber();
            $newRegistrationNumber = $this->setAbbreviationFormat($getLastIDInserted['numberGenerated'], $this->resutlFormat);
        } catch (\Throwable  $e) {
            $getLastIDInserted = [];
            $newRegistrationNumber = 0;
        }
        //Update DB
        try{
            ($getLastIDInserted['lastRegistrationNumber'] ? $this->updateRecordDB($getLastIDInserted['lastRegistrationNumber'], $newRegistrationNumber) : '');
        } catch (\Throwable  $e) {}


       return $newRegistrationNumber;
    }//



    //Set Abbreviation Format
    private function setAbbreviationFormat($setRegistrationNumber, $resutlFormat)
    {
        switch($resutlFormat)
        {
            case 1:
                if(($this->abbreviation1 <> null) && ($this->abbreviation2 <> null) && ($this->abbreviation3 <> null))
                {
                    $abbreviationFormat = $setRegistrationNumber . $this->separator . $this->abbreviation1 . $this->separator . $this->abbreviation2 . $this->separator . $this->abbreviation3;
                }else if(($this->abbreviation1 <> null) && ($this->abbreviation2 <> null) && ($this->abbreviation3 == null))
                {
                    $abbreviationFormat = $setRegistrationNumber . $this->separator . $this->abbreviation1 . $this->separator . $this->abbreviation2;
                }else if(($this->abbreviation1 <> null) && ($this->abbreviation2 == null) && ($this->abbreviation3 == null))
                {
                    $abbreviationFormat = $setRegistrationNumber . $this->separator . $this->abbreviation1;
                }else{
                    $abbreviationFormat = $setRegistrationNumber . $this->separator . (($this->autoIncrement == true) ? substr(($_SERVER['SERVER_NAME']), 0, 3) : '');
                }
            break;

            case 2:
                if(($this->abbreviation1 <> null) && ($this->abbreviation2 <> null) && ($this->abbreviation3 <> null))
                {
                    $abbreviationFormat = $this->abbreviation1 . $this->separator . $this->abbreviation2 . $this->separator . $setRegistrationNumber . $this->separator . $this->abbreviation3;
                }else if(($this->abbreviation1 <> null) && ($this->abbreviation2 <> null) && ($this->abbreviation3 == null))
                {
                    $abbreviationFormat = $this->abbreviation1 . $this->separator . $setRegistrationNumber . $this->separator . $this->abbreviation2;
                }else if(($this->abbreviation1 <> null) && ($this->abbreviation2 == null) && ($this->abbreviation3 == null))
                {
                    $abbreviationFormat = $this->abbreviation1 . $this->separator .$setRegistrationNumber;
                }else{
                    $abbreviationFormat = (($this->autoIncrement == true) ? substr(($_SERVER['SERVER_NAME']), 0, 3) : '') . $this->separator .$setRegistrationNumber;
                }
            break;

            case 3:
                if(($this->abbreviation1 <> null) && ($this->abbreviation2 <> null) && ($this->abbreviation3 <> null))
                {
                    $abbreviationFormat = $this->abbreviation1 . $this->separator . $setRegistrationNumber . $this->separator . $this->abbreviation2 . $this->separator . $this->abbreviation3;
                }else if(($this->abbreviation1 <> null) && ($this->abbreviation2 <> null) && ($this->abbreviation3 == null))
                {
                    $abbreviationFormat = $this->abbreviation1 . $setRegistrationNumber . $this->separator . $this->abbreviation2;
                }else if(($this->abbreviation1 <> null) && ($this->abbreviation2 == null) && ($this->abbreviation3 == null))
                {
                    $abbreviationFormat = $this->abbreviation1 . $this->separator .$setRegistrationNumber;
                }else{
                    $abbreviationFormat = $setRegistrationNumber . $this->separator . (($this->autoIncrement == true) ? substr(($_SERVER['SERVER_NAME']), 0, 3) : '');
                }
            break;

            default:
                if(($this->abbreviation1 <> null) && ($this->abbreviation2 <> null) && ($this->abbreviation3 <> null))
                {
                    $abbreviationFormat = $this->abbreviation1 . $this->separator . $this->abbreviation2 . $this->separator . $this->abbreviation3 . $this->separator . $setRegistrationNumber;
                }else if(($this->abbreviation1 <> null) && ($this->abbreviation2 <> null) && ($this->abbreviation3 == null))
                {
                    $abbreviationFormat = $this->abbreviation1 . $this->separator . $this->abbreviation2 . $this->separator . $setRegistrationNumber;
                }else if(($this->abbreviation1 <> null) && ($this->abbreviation2 == null) && ($this->abbreviation3 == null))
                {
                    $abbreviationFormat = $this->abbreviation1 . $this->separator . $setRegistrationNumber;
                }else{
                    $abbreviationFormat = (($this->autoIncrement == true) ? substr(($_SERVER['SERVER_NAME']), 0, 3) : '') . $this->separator . $setRegistrationNumber;
                }
        }//end switch

       return strtoupper($abbreviationFormat);
    }//


    //Set Registration Number
    private function setLastRegistrationNumber()
    {
        $data['lastRegistrationNumber'] = ($this->getLastAutoincrementID());
        if($this->autoIncrement == false)
        {
            if($this->random == true)
            {
                $numberCode = $this->get_rand_alphanumeric($this->length);
            }else if( $this->numericOnly == true && $this->letterOnly == false)
            {
                $numberCode = $this->get_rand_numbers($this->length);
            }else if($this->letterOnly == true &&  $this->numericOnly == false)
            {
                $numberCode = $this->get_rand_letters($this->length);
            }else{
                $numberCode = $this->get_rand_alphanumeric($this->length);
            }

        }else{
            $numberCode = $data['lastRegistrationNumber'];
        }
        $data['numberGenerated'] = $numberCode;
        return $data;
    }

    //Get Last Auto-increment Number
    private function getLastAutoincrementID()
    {
        if(Schema::hasTable($this->tableNameRegNum))
        {
            try{
                $lastID = $this->InsertRecordDB($this->startFrom);
                //$lastID = DB::table($this->tableNameRegNum)->orderBy($this->regID, 'Desc')->value($this->regID);
                //$lastID = ($lastID ? $lastID : 0);
            } catch (\Throwable  $e) {
                $lastID = 0;
            }
        }else{
            $lastID = 0;
        }

        return  $lastID;
    }

    //Create Table to keep track of Auto-increment
    private function createTableAutoincrement()
    {
        $data['tableMessage']   = "Tracking Table Not Created or Already Created!";
        $data['tableStatus']    = 0; //0-Not Success, 1-successful
        $this->errorFlag        = 0;

        if(!Schema::hasTable($this->tableNameRegNum))
        {
            try{
                Schema::create($this->tableNameRegNum, function (Blueprint $table) {
                    $table->bigIncrements($this->regID);
                    $table->bigInteger($this->total_user)->nullable();
                    $table->string($this->date)->nullable();
                    $table->text($this->regNumCreated)->nullable();
                    $table->bigInteger($this->start_auto)->default(1);
                });
                $data['tableMessage'] = "Tracking Table Created Successfully";
                $this->errorFlag = 0;
            } catch (\Throwable  $e) {
                $this->errorFlag = 1;
            }
        }
        $data['tableStatus'] = $this->errorFlag;

        return  $data;
    }

    //Add new registration number to DB
    private function InsertRecordDB($startFrom = 1)
    {
        try{
            if(Schema::hasTable($this->tableNameRegNum))
            {
                $getStartAuto = (DB::table($this->tableNameRegNum)->first() ? DB::table($this->tableNameRegNum)->orderby($this->regID, 'Asc')->value($this->start_auto) : 0);
                if(($getStartAuto > 0) && ($getStartAuto <> $startFrom))
                {
                    //duplicate Table

                    //Truncate Table
                    DB::table($this->tableNameRegNum)->delete();

                    //Start from newly Auto- start
                    $insertGetId = DB::table($this->tableNameRegNum)->insertGetId([
                        $this->regID => $startFrom,
                        $this->total_user => count(DB::table($this->tableNameRegNum)->get()) + 1,
                        $this->start_auto => $startFrom,
                        $this->date  => date('Y-m-d'),
                    ]);
                }else if(($getStartAuto > 0) || ($getStartAuto <> 0))
                {
                    $insertGetId = DB::table($this->tableNameRegNum)->insertGetId([
                        $this->total_user => count(DB::table($this->tableNameRegNum)->get()) + 1,
                        $this->start_auto => $startFrom,
                        $this->date  => date('Y-m-d'),
                    ]);
                }else{
                    $insertGetId = DB::table($this->tableNameRegNum)->insertGetId([
                        $this->regID => $startFrom,
                        $this->total_user => count(DB::table($this->tableNameRegNum)->get()) + 1,
                        $this->start_auto => $startFrom,
                        $this->date  => date('Y-m-d'),
                    ]);
                }

            }
        } catch (\Throwable  $e) { $insertGetId = 0; }

        return $this->formatIDToDigitsLength($insertGetId);
    }


    //Format Registration Number to 5 Digits
    private function formatIDToDigitsLength($IDString = null)
    {
        if(strlen($IDString) < 2){
            $newIDString = substr($this->zeroPrefix, 0, ($this->length > 4 ? $this->length - 1 : 4)) . ($IDString);
        }elseif(strlen($IDString) < 3){
            $newIDString = substr($this->zeroPrefix, 0, ($this->length > 4 ? $this->length - 2 : 3)) . ($IDString);
        }elseif(strlen($IDString) < 4){
            $newIDString = substr($this->zeroPrefix, 0, ($this->length > 4 ? $this->length - 3 : 2)) . ($IDString);
        }elseif(strlen($IDString) < 5){
            $newIDString = substr($this->zeroPrefix, 0, ($this->length > 4 ? $this->length - 4 : 1)) . ($IDString);
        }else{
            $newIDString = ($IDString);
        }

        return $newIDString;
    }

    //Update DB - Store Full registration Number Generated
    private function updateRecordDB($id = null, $value = null)
    {
        try{
            if(Schema::hasTable($this->tableNameRegNum))
            {
                if(($id <> null) && ($id > 0))
                {
                   DB::table($this->tableNameRegNum)->where($this->regID, $id)->update([
                        $this->regNumCreated => $value
                    ]);
                }
            }
        } catch (\Throwable  $e) {  }

        return;
    }


    //PIN Alpha-Numeric only
    private function get_rand_alphanumeric($length = 10)
    {
        if ($length > 0) {
            $rand_id = null;
            try{
                for ($i = 1; $i <= $length; $i++)
                {
                    mt_srand((double)microtime() * 1000000);
                    $num = mt_rand(1, 36);
                    $rand_id .= $this->assign_rand_value($num);
                }
            } catch (\Throwable  $e) {
                $rand_id = null;
            }
        }
        return strtoupper($rand_id);
    }

    //PIN Numeric Only
    private function get_rand_numbers($length = 10)
    {
        if ($length > 0)
        {
            $rand_id = 0;
            try{
                for($i = 1; $i <= $length; $i++)
                {
                    mt_srand((double)microtime() * 1000000);
                    $num = mt_rand(27, 36);
                    $rand_id .= $this->assign_rand_value($num);
                }
            } catch (\Throwable  $e) {
                $rand_id = 0;
            }
        }
        return strtoupper($rand_id);
    }

    //PIN Letter Only
    private function get_rand_letters($length = 10)
    {
        if ($length > 0) {
            $rand_id = null;
            try{
                for($i=1; $i<=$length; $i++)
                {
                    mt_srand((double)microtime() * 1000000);
                    $num = mt_rand(1, 26);
                    $rand_id .= $this->assign_rand_value($num);
                }
            } catch (\Throwable  $e) {
                $rand_id = null;
            }
        }
        return strtoupper($rand_id);
    }

    //PIN Accept 1-36 Only
    private function assign_rand_value($num = 10)
    {
        // accepts 1 - 36
        switch($num)
        {
            case "1"  : $rand_value = "a"; break;
            case "2"  : $rand_value = "b"; break;
            case "3"  : $rand_value = "c"; break;
            case "4"  : $rand_value = "d"; break;
            case "5"  : $rand_value = "e"; break;
            case "6"  : $rand_value = "f"; break;
            case "7"  : $rand_value = "g"; break;
            case "8"  : $rand_value = "h"; break;
            case "9"  : $rand_value = "i"; break;
            case "10" : $rand_value = "j"; break;
            case "11" : $rand_value = "k"; break;
            case "12" : $rand_value = "l"; break;
            case "13" : $rand_value = "m"; break;
            case "14" : $rand_value = "n"; break;
            case "15" : $rand_value = "o"; break;
            case "16" : $rand_value = "p"; break;
            case "17" : $rand_value = "q"; break;
            case "18" : $rand_value = "r"; break;
            case "19" : $rand_value = "s"; break;
            case "20" : $rand_value = "t"; break;
            case "21" : $rand_value = "u"; break;
            case "22" : $rand_value = "v"; break;
            case "23" : $rand_value = "w"; break;
            case "24" : $rand_value = "x"; break;
            case "25" : $rand_value = "y"; break;
            case "26" : $rand_value = "z"; break;
            case "27" : $rand_value = "0"; break;
            case "28" : $rand_value = "1"; break;
            case "29" : $rand_value = "2"; break;
            case "30" : $rand_value = "3"; break;
            case "31" : $rand_value = "4"; break;
            case "32" : $rand_value = "5"; break;
            case "33" : $rand_value = "6"; break;
            case "34" : $rand_value = "7"; break;
            case "35" : $rand_value = "8"; break;
            case "36" : $rand_value = "9"; break;
            default: 0;
        }
        return $rand_value;
    }


}//end class
