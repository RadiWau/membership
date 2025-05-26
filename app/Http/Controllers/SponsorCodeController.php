<?php

namespace App\Http\Controllers;

use App\Helper\Logger;
use App\Http\Controllers\Controller;
use App\Traits\AjaxResponseTrait;
use Exception;
use Str;
use App\Models\User;
use App\Models\MemberSponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SponsorCodeController extends Controller
{
    use AjaxResponseTrait;

    public function __construct(){
        $this->middleware('auth.admin');
    }
    
    // GENERATE SPONSOR CODE
    public function generateSponsorCode($user_id){
        try {

            $cekData    = MemberSponsor::where('user_id', $user_id)->first();
            if($cekData){
                return $cekData->sponsor_code;
            }
            
            $user       = User::find($user_id);
            $rand       = rand(0000, 9999);
            $date       = date('ym');
            $prefix     = "SPC";
            $ponsorCode = $prefix.$rand.$date.$user->user_id;
            
            $sponsor = new MemberSponsor;
            $sponsor->sponsor_code = $ponsorCode;
            $sponsor->user_id = $user->user_id;
            $sponsor->created_at = Now();
            $sponsor->created_by = Auth::guard('admin')->user()->user_id;
            $sponsor->save();

            return $ponsorCode;
            
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