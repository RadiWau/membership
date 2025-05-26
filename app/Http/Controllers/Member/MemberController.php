<?php

namespace App\Http\Controllers\Member;

use App\Helper\Logger;
use App\Http\Controllers\Controller;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\LogsMemberController;
use App\Models\Customers;
use App\Models\Users;
use App\Models\MemberPaket;
use App\Traits\AjaxResponseTrait;
use Exception;
use Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    use AjaxResponseTrait;

    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index(){
        return view('Member.index');
    }

    public function topupGold(Request $request){
        try{

            // insert paket
            
            $general = new GeneralController();
            $saldo     = $general->cleanNumber($request->txt_nominal)-10000;
            
            $paket               = new MemberPaket();
            $paket->paket_level  = 2;
            $paket->user_id      = Auth::guard('web')->user()->user_id;
            $paket->saldo        = $saldo;
            $paket->status_paket = 1;
            $paket->created_by   = Auth::guard('web')->user()->user_id;
            $paket->save();
            
            $logsMember = new LogsMemberController();
            $logsArray = array();
            $logsArray['Member']          = Auth::guard('web')->user()->user_id;
            $logsArray['AktifitasiTipe']  = "Topup Paket <br/>";
            $logsArray['Aktifitas']      = "Paket : ".$general->paketLevel(2)." <br/>
                Nominal Topup : ".$request->txt_nominal."<br/>
            ";
            
            // INSERT LOGS MEMBER
            $logsMember->Insert($logsArray);

            return redirect()->to('/dashboard')->with('topup_sukses', 'Silahkan topup sebesar '.$request->txt_nominal.'  dan kirimkan bukti topup ke admin');
        }
        catch (Exception $e) {

            Logger::error($e->getMessage(), 'Dashboard', 'Dashboard');
            return redirect()->to('/dashboard')->with('topup_gagal', 'Topup gagal, Silahkan Hubungi Administrator');

        }
    }
    

    
}
