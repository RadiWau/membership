<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GeneralController;
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
        return view('Auth.forgot-password');
    }

    public function formForgotPassword($code)
    {
        $verify_code = User::where('verify_code', $code)->first();
        if($verify_code){
            return view('Auth.form-forgot-password');
        }

        return view('errors.404'); 
    }

    public function actionForget(Request $request){
        
        try{

            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'txt_email'=>'required'
            ], [
                'txt_email.required'     =>'Email Tidak Boleh Kosong'
            ]);

            if ($validator->fails()){
                DB::rollback();
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $user = User::where('email', $request->txt_email)->first();
            if($user){

                return redirect()->route('auth.forgot')->with('regis_success', 'Silahkan cek email anda untuk proses lupa kata sandi');
                
            }

            DB::commit();
            return redirect()->route('auth.forgot')->with('regis_failed', 'Email Tidak Ditemukan');

        }catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: '.$e->getMessage());
        }    
            
    }

    public function actionFormForgetPassword(Request $request){
        
        try{
            
            $code = "67117df1e2ca460c52084ca261aa85e8";
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'txt_sandi'=>'required',
                'txt_sandi_ulangi'=>'required'
            ], [
                'txt_sandi.required'     =>'Sandil Tidak Boleh Kosong',
                'txt_sandi_ulangi.required'     =>'Sandi Tidak Boleh Kosong',
            ]);

            if ($validator->fails()){
                DB::rollback();
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            if($request->txt_sandi !== $request->txt_sandi_ulangi){
                return redirect()->route('auth.form-forgot')->with('forgot_failed', 'Pastikan Kata Sandi & Ulangi Kata Sandi Sudah Sama');
            }

            $user = User::find('5202d1bb-f081-4f79-b3f8-812c2e4c6342');
            if($user){
                $user->verify_code = "";
                $user->update();
            }
            else {
                return redirect()->to('form-forgot-password/'.$code)->with('forgot_failed', 'User Tidak Ditemukan, Silahkan Hubungi Administrator');
            }

            DB::commit();
            return view('Auth.forgot-password-success')->with('forgot_success', 'Success BRO');

        }catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: '.$e->getMessage());
        }    
            
    }
}
