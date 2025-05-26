<?php

namespace App\Http\Controllers;

use App\Helper\Logger;
use App\Http\Controllers\Controller;
use App\Traits\AjaxResponseTrait;
use Exception;
use Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StatusController extends Controller
{
    use AjaxResponseTrait;

    public function __construct(){
        $this->middleware('auth.admin');
    }
    
    // FOR MEMBER
    public function getStatusAkun($value){
        try {
            /**
             * 1 = Registrasi
             * 2 = Aktif
             * 3 = Not Aktif
             * 4 = Expired
             */
            $status = "";

            if($value == 1){
                $status = "Registrasi";
            }
            else if($value == 2){
                $status = "Aktif";
            }
            else if($value == 3){
                $status = "Not Aktif";
            }
            else if($value == 4){
                $status = "Expired";
            }else{
                $status = "Undefined";
            }

            return $status;
        }
        catch (Exception $e) {

            return $status = "Not Found";
        }

    }

    public function getStatusAkunAdmin($value){
        try {
            
            /**
             * 1 = Aktif
             * 2 = Not Aktif
             */
            $status = "";

            if($value == 1){
                $status = "Aktif";
            }
            else if($value == 2){
                $status = "Not Aktif";
            }else{
                $status = "Undefined";
            }

            return $status;
        }
        catch (Exception $e) {

            return $status = "Not Found";
        }

    }   

    public function getStatusPaket($value){

        try {
            
            /**
             * 1 = Belum Topup
             * 2 = Sudah Berhasil
             */
            $status = "";

            if($value == 1){
                $status = "Belum Topup";
            }
           else{
                $status = "Sudah Topup";
            }

            return $status;
        }
        catch (Exception $e) {

            return $status = "Tidak Ditemukan";
        }

    }

    
    
}