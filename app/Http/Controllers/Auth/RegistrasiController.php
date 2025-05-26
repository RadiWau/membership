<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\MemberCardController;
use App\Http\Controllers\LogsMemberController;
use App\Models\User;
use App\Models\MemberPaket;
use App\Models\MemberSponsor;
use App\Models\SponsorDetails;
use App\Models\LogsMember;
use Mail;
use App\Mail\EmailInfoRegisMember;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Encryption\DecryptException;


class RegistrasiController extends Controller
{
    protected $general, $logsMember;

    public function __construct(
        GeneralController $general, LogsMemberController $logsMember,
        MemberCardController $memberCard
    ){
        $this->general = $general;
        $this->logsMember = $logsMember;
    }
    
    public function index()
    {
        return view('Auth.register');
    }

    public function action_registrasi(Request $request){
        
        return $this->general->getMemberCard(36);
        // try{
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'txt_username'=>'required|unique:users,username',
                'txt_nama'=>'required|string',
                'txt_no_hp'=>'required|unique:users,no_hp',
                'txt_paket'=>'required|integer',
                'txt_provinsi'=>'required|string',
                'txt_kabupaten'=>'required|string',
                'txt_kecamatan'=>'required|string',
                'txt_kelurahan'=>'required|string',
                'txt_alamat'=>'required|string',
                'txt_bank'=>'required|string',
                'txt_atas_nama'=>'required|string',
                'txt_nomor_rekening'=>'required'
            ], [
                'txt_username.required' =>'Username Tidak Boleh Kosong',
                'txt_username.unique'      =>'Username Sudah Digunakan',
                'txt_nama.required'     =>'Nama Lengkap Tidak Boleh Kosong',
                'txt_no_hp.required'    =>'Nomor Hp Tidak Boleh Kosong',
                'txt_no_hp.unique'      =>'Nomor Hp Sudah Digunakan',
                'txt_paket.required'    =>'Paket Tidak Boleh Kosong',
                'txt_provinsi.required' =>'Provinsi Tidak Boleh Kosong',
                'txt_kabupaten.required'=>'Kabupaten Tidak Boleh Kosong',
                'txt_kecamatan.required'=>'Kecamatan Tidak Boleh Kosong',
                'txt_kelurahan.required'=>'Kelurahan Tidak Boleh Kosong',
                'txt_alamat.required'   =>'Alamat Tidak Boleh Kosong',
                'txt_bank.required'     =>'Bank Tidak Boleh Kosong',
                'txt_atas_nama.required'=>'Atas Nama Tidak Boleh Kosong',
                'txt_nomor_rekening.required'=>'Nomor Rekening Tidak Boleh Kosong'
            ]);

            if ($validator->fails()){
                // return $validator->fails();
                DB::rollback();
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('regis_gagal', 'Registrasi gagal, Pastikan anda sudah mengisi data dengan benar, Silahkan dicoba kembali');
            }
         
            
            $nominal     = $request->txt_paket == 1 ? $this->general->paketPrice(1) : $request->txt_nominal;
            $trimNominal = str_replace('.', '', $nominal);
            $saldo       = $trimNominal - 10000;


            if($request->txt_paket == 2 && $trimNominal < 61000){
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('regis_gagal', 'Registrasi gagal, Nominal topup kurang dari minimal topup 610.000');
            }

            $users               = new User();
            $users->username     = $request->txt_username;
            $users->nama_lengkap = $request->txt_nama;
            $users->email        = $request->txt_email;
            $users->no_hp        = $request->txt_no_hp;
            $users->provinsi     = $request->txt_provinsi;
            $users->kabupaten    = $request->txt_kabupaten;
            $users->kecamatan    = $request->txt_kecamatan;
            $users->kelurahan    = $request->txt_kelurahan;
            $users->alamat       = $request->txt_alamat;
            $users->bank         = $request->txt_bank;
            $users->atas_nama    = $request->txt_atas_nama;
            $users->norek        = $request->txt_nomor_rekening;
            $users->status       = 1;
            $users->password     = Hash::make("mandali123456");
            $users->save();
            
            // insert paket            

            $paket               = new MemberPaket();
            $paket->paket_level  = $request->txt_paket;
            $paket->user_id      = $users->user_id;
            $paket->saldo        = $saldo;
            $paket->status_paket = 1;
            $paket->save();
            
            if($request->txt_kode_sponsor !== null ){
                $sponsor = new SponsorDetails;
                $sponsor->sequence_parent = $request->txt_kode_sponsor;
                $sponsor->user_id = $users->user_id;
                $sponsor->status  = 1;
                $sponsor->created_at = now();
                $sponsor->created_by = $users->user_id;
                $sponsor->save();
                
            }
            
            $dataEmail = array();
            $data['nama']   = $users->nama_lengkap;
            $data['paket']  = $this->general->paketPrice($request->txt_paket);
            

            
            $logsArray = array();
            $logsArray['Member']          = $users->user_id;
            $logsArray['AktifitasiTipe']  = "Registrasi Data <br/>";
            $logsArray['PaketLevel']      = "Paket : ".$this->general->paketLevel($request->txt_paket)." <br/>";
            $logsArray['DataProfile']     = $users;
            
            // INSERT LOGS MEMBER
            $this->logsMember->Insert($logsArray);
            
            DB::commit();
            
            // $isiEmail       = new EmailInfoRegisMember($dataEmail);
		    // Mail::to($user->email)->send($isiEmail);

            return redirect()->route('auth.regis')->with('regis_success', 'Registrasi berhasil.
            silahkan toup sebesar '.$nominal.',
            dan bukti topup informasikan ke admin.
            ');

        // }catch (\Exception $e) {
        //     DB::rollback();
        //     return redirect()->back()->with('error', 'Terjadi kesalahan: '.$e->getMessage());
        // }    
            
    }

    public function regisReferal($referal){
        try {

            $user = MemberSponsor::LeftJoin('users', 'users.user_id', 'member_sponsor.user_id')
            ->where('member_sponsor.sponsor_code', $referal)->first();
            
            if($user){
                if($user->status == 2){
                    return view('auth.register-referal')->with('referal', $referal);
                }else{
                    return view('errors.404');
                }
            }else{
                return view('errors.404');
            }
        } catch (DecryptException $e) {
            abort(404, 'Invalid or tampered link.');
        }
    }

    public function TestEmail(){
        return view('email.mail-after-register');
    }
}
