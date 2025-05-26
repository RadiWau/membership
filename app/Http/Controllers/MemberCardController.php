<?php

namespace App\Http\Controllers;

use App\Helper\Logger;
use App\Http\Controllers\Controller;
use App\Traits\AjaxResponseTrait;
use Exception;
use Str;
use App\Models\User;
use App\Models\MemberCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MemberCardController extends Controller
{
    use AjaxResponseTrait;

    public function __construct(){
        // $this->middleware('auth.admin');
    }
    
    // GENERATE SPONSOR CODE
    public function generateMemberCard($user_id){
        try {

            $memberCard = MemberCard::orderBy('sequence_no', 'DESC')->first(); // check if null
            $user = User::find($user_id);
            $date = date('Y-m-d');

            if($memberCard){
                
                $data = MemberCard::where('user_id', $user->user_id)->first();
                if($data){
                    return false;
                }

                $insertCard                   = new MemberCard;
                $insertCard->user_id          = $user->user_id;
                $insertCard->date_create      = date('Y-m-d'); 
                $insertCard->date_expired     = date('Y-m-d', strtotime($date . ' +1 year'));
                $insertCard->sequence_no      = $memberCard->sequence_no+1;
                $insertCard->status           = 1;  
                $insertCard->save();  

            }else{

                $insertCard                   = new MemberCard;
                $insertCard->user_id          = $user->user_id;
                $insertCard->date_create      = date('Y-m-d'); 
                $insertCard->date_expired     = date('Y-m-d', strtotime($date . ' +1 year'));
                $insertCard->sequence_no      = 1;
                $insertCard->status           = 1;  
                $insertCard->save();  
            }

            return $insertCard;
        }
        catch (Exception $e) {

            return $status = "Not Found";
        }
    }

    public function getMemberCard($id){
        return $id;
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