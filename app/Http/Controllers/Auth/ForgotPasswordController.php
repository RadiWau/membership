<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\StatusController;
use App\Models\User;
use App\Models\MemberPaket;
use App\Models\Logs;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('auth.forgot-password');
    }

    public function actionFormCekUsername(Request $request){
        
        try{
            
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'txt_username'=>'required'
            ], [
                'txt_username.required'     =>'Username Tidak Boleh Kosong'
            ]);

            if ($validator->fails()){
                DB::rollback();
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $status = new StatusController();
            $user   = User::where('username', $request->txt_username)->first();
            
            if(!$user){
                return redirect()->route('auth.forgot')->with('cek_failed', 'Username Tidak Ditemukan');
            }

            if($user->status !== 2){
                return redirect()->route('auth.forgot')->with('cek_failed', 'Status Member '.$user->nama_lengkap.' '.$status->getStatusAkun($user->status).', Silahkan hubungi administrator  ');
            }

            return view('auth.form-password')->with('username_value', $user->username);


        }catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: '.$e->getMessage());
        }    
            
    }

    public function actionForgotPassword(Request $request){
        try{

            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'txt_sandi'=>'required',
                'txt_sandi_ulangi'=>'required'
            ], [
                'txt_sandi.required'         =>'Kata Sandi Tidak Boleh Kosong',
                'txt_sandi_ulangi.required'  =>'Kata Sandi Tidak Boleh Kosong'
            ]);

            if ($validator->fails()){
                DB::rollback();
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $user = User::where('username', $request->username)->first();
            if(!$user){
                return redirect()->route('auth.forgot')->with('cek_failed', 'Username Tidak Ditemukan');
            }

            $user = User::where('username', $request->username)->update([
                'password'=>Hash::make($request->txt_sandi)
            ]);

            DB::commit();
            return redirect()->route('login')->with('login_success', 'Kata Sandi Berhasil di Perbarui');

        }catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: '.$e->getMessage());
        }    
            
    }
}
