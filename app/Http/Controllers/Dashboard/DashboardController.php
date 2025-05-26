<?php

namespace App\Http\Controllers\Dashboard;

use App\Helper\Logger;
use App\Http\Controllers\Controller;
use App\Models\Access;
use App\Traits\AjaxResponseTrait;
use Exception;
// use Session;
use App\Models\User;
use App\Models\MemberPaket;
use App\Models\MemberCard;
use App\Models\MemberSponsor;
use App\Models\SponsorDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
{
    
    public function __construct(){
        $this->middleware('auth');
    }
       
    public function DashboardPage(){

        try {
            
            $memberPaketSilver    = MemberPaket::where('user_id', Auth::guard('web')->user()->user_id)->where('paket_level', 1)->where('status_paket', 2)->first();
            $memberPaketGold      = MemberPaket::where('user_id', Auth::guard('web')->user()->user_id)->where('paket_level', 2)->first();
            
            return view('Dashboard.index')
            ->with('paketSilver', $memberPaketSilver)
            ->with('paketGold', $memberPaketGold);

        } catch (Exception $e) {

            Logger::error($e->getMessage(), 'Dashboard', 'Dashboard');

            return $this->failure('Terjadi Kesalahan Saat mengambil data benefit', 500);
        }
    }

    public function showAll(Request $request){
       try {

            $member = User::LeftJoin('member_paket', 'users.user_id', 'member_paket.user_id')
                ->leftJoin('member_sponsor', 'member_sponsor.user_id', 'users.user_id')
                ->get(['users.*', 'member_sponsor.sponsor_code', 'member_paket.paket_level', 'member_paket.status_paket']);
            

            $i = 1;
            $data = array();
            $statusMember = new StatusController();
            $paket        = new GeneralController();

            foreach($member as $row){

                $column["no"]               = $i;
                $column["user_id"]          = $row->user_id;
                $column["paket"]            = $row->paket_level;
                $column["paket_value"]      = $paket->paketLevel($row->paket_level);
                $column["sponsor_code"]     = $row->sponsor_code;
                $column["nama_lengkap"]     = $row->nama_lengkap;
                $column["no_hp"]            = $row->no_hp;
                $column["status_member"]    = $statusMember->getStatusAkun($row->status);
                $column["status"]           = $row->status;
                $data[]                     = $column;
                $i++;
            }

            $parsingJSON = array("data" => $data);
            Logger::info('All User Data', 'showAll', 'Member');

            return $this->success('All Member', $data);

        } catch (Exception $e) {

            Logger::error($e->getMessage(), 'showAll', 'Member');

            return $this->failure('Terjadi Kesalahan Saat mengambil data Member', 500);
        }
    }

}
