<?php

namespace App\Http\Controllers\Administrator\Member;

use App\Helper\Logger;
use App\Http\Controllers\Controller;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\MemberCardController;
use App\Http\Controllers\SponsorCodeController;
use App\Models\Logs;
use App\Models\User;
use App\Models\MemberPaket;
use App\Models\MemberCard;
use App\Models\MemberSponsor;
use App\Models\SponsorDetails;
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
        $this->middleware('auth.admin');
    }
    
    public function index(){
        return view('Administrator.Content.Member.index');
    }
    
    public function countMemberPaket(){
        $summarySilver = MemberPaket::where('paket_level', 1)->where('status_paket', 2)->count();
        $summaryGold = MemberPaket::where('paket_level', 2)->where('status_paket', 2)->count();
        $data = array(['silver'=>$summarySilver, 'gold'=>$summaryGold]);
        return $data;
    }
    
    // detil profile
    public function detilMember($id){
        try {

            $profile = User::find($id);

            if(!$profile){

                return redirect()->route('member.index');

            }
            $memberPaketSilver    = MemberPaket::where('user_id', $profile->user_id)->where('paket_level', 1)->first();
            $memberPaketGold      = MemberPaket::where('user_id', $profile->user_id)->where('paket_level', 2)->first();
            $memberCard           = MemberCard::where('user_id', $profile->user_id)->first();
            $memberSponsor        = MemberSponsor::where('user_id', $profile->user_id)->first();
            $memberStatus         = new StatusController();
            
            return view('Administrator.Content.Member.detil')
            ->with('profile', $profile)
            ->with('profile_status', $memberStatus->getStatusAkun($profile->status))
            ->with('card', $memberCard)
            ->with('sponsor', $memberSponsor)
            ->with('paketSilver', $memberPaketSilver)
            ->with('paketGold', $memberPaketGold);

        } catch (Exception $e) {

            Logger::error($e->getMessage(), 'Detil Member', 'ProfileMember');

            return $this->failure('Terjadi Kesalahan Saat mengambil data Member', 500);
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

    public function ActionTopup(Request $request){
        
        try{

            $user     = User::find($request->txt_user);

            $memberPaket = MemberPaket::where('user_id', $user->user_id)
            ->where('paket_level',$request->paket_level)
            ->where('status_paket', 1)
            ->first();


            if(!$memberPaket){
                return redirect()->to('/admin/member/detil_member/'.$user->user_id.'')->with('topup_gagal', 'Paket Tidak Ditemukan, silahkan hubungi administrator');
            }

            $general                = new GeneralController();
            // $generateMemberCard     = new MemberCardController();
            $generateSponsore       = new SponsorCodeController();
            // $memberCard             = $generateMemberCard->generateMemberCard($user->user_id);
            $memberSponsor          = $generateSponsore->generateSponsorCode($user->user_id);
            
            // upload file topup
            $pathTopup       = "";
            $file            = $request->file("txt_file");
            if($request->hasFile("txt_file")){

                $lampiranPath   	= "paket/".$memberPaket->paket_level.'/'.$memberSponsor;
                $filename       	= $memberSponsor."_".$memberPaket->paket_level.'-'.date('dmY His')."." . $file->getClientOriginalExtension();

                $pathTopup   		= $file->storeAs($lampiranPath, $filename, 'public');

                // update paket
                $updatePaket = MemberPaket::where('paket_id', $memberPaket->paket_id)
                ->update([
                    'image_topup'  => $pathTopup,
                    'status_paket' => 2
                ]);

            }
            
            // update user
            $user->status = 2; 
            $user->save(); 
            
            
            $sponsor = SponsorDetails::where('user_id', $user->user_id)->where('status', 1)->first();

            if($sponsor){
                $ponsorDetailsUpdate = SponsorDetails::where('user_id', $user->user_id)
                ->where('status', 1)
                ->update(['sponsor_code'=> $memberSponsor, 'status'=>2]);
            }

            $aktifitas  = "TOPUP ".$general->paketLevel($memberPaket->paket_level)." <br/>
                Member : ".$user->nama_lengkap. " 
            ";

            $logs                   = new Logs;
            $logs->user_id          = $user->user_id;
            $logs->aktifitas        = $aktifitas;
            $logs->created_at       = now();
            $logs->created_by       = Auth::guard('admin')->user()->admin_id;
            $logs->save();

            return redirect()->to('/admin/member/detil_member/'.$user->user_id.'')->with('topup_sukses', 'Topup Berhasil dilakukan');
            
            
        }
         catch (Exception $e) {

            Logger::error($e->getMessage(), 'showAll', 'Member');

            return $this->failure('Terjadi Kesalahan Saat Proses Paket Member', 500);
        }
    }

    public function showTopUp($user, $paket){
        $file = new FileController();
        return $file->ReadAttachmentTopUp($user, $paket);
    }

    public function actionGantiPassword(Request $request){
        try {

            DB::beginTransaction();

            $member = User::find($requst->user_id);

            if ($user) {

                $password   = Hash::make($request->txt_sandi);
                $update     = User::where('user_id', $user->user_id)->update(['password'=>$password]);
                DB::commit();

                return redirect()->to('admin/member/detil_member/'.$user->user_id)->with('w', 'Kata Sandi Berhasil Dirubah');
            }

            DB::rollback();
            return redirect()->to('admin/member/')->with('user_gagal', 'Memeber Tidak Ditemukan');
            
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: '.$e->getMessage());
       
        }
    }

    public function actionMemberCard(Request $request){
        try {

            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'txt_member_card'=>'required|unique:member_card,member_card_no'
            ], [
                'txt_member_card.required' =>'Nomor Kartu Tidak Boleh Kosong',
                'txt_username.unique'      =>'Nomor Kartu Sudah Digunakan'
            ]);

            if ($validator->fails()){
                DB::rollback();
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('topup_gagal', "Nomor Kartu Tidak Boleh Kosong atau Nomor Kartu Sudah Digunakan");
            }

            $user = User::find($request->user_id);

            if ($user) {
                
                $memberCard = MemberCard::where('user_id', $user->user_id)->first();

                if($memberCard){

                    $updateCard = MemberCard::where('user_id', $user->user_id)->update([
                        'member_card_no' => $request->txt_member_card, 'updated_at'=>now()
                    ]);
                }

                $insertCard                 = new MemberCard;
                $insertCard->user_id        = $user ->user_id;
                $insertCard->member_card_no = $request->txt_member_card;
                $insertCard->status         = 1;
                $insertCard->created_at     = now();
                $insertCard->created_by     = Auth::guard('admin')->user()->admin_id;;
                $insertCard->save();
                
                DB::commit();
                return redirect()->to('admin/member/detil_member/'.$user->user_id)->with('user_success', 'Nomor Kartu Berhasil Dsimpan');
            }

            DB::rollback();
            return redirect()->to('admin/member/')->with('user_gagal', 'Memeber Tidak Ditemukan');
            
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: '.$e->getMessage());
       
        }
    }
}
