<?php

namespace App\Http\Controllers\Administrator\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    // public function index()
    // {
    //     if(!Auth::guard('web')->check()){
    //         return view('auth.login');
    //     }
        
    // }
    public function index()
    {
        return view('Administrator.Content.Auth.login');
    }

    public function actionLogin(Request $request){
        try{
        
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'txt_email'=>'required',
                'txt_password'=>'required'
            ], [
                'txt_email.required'     =>'Email tidak boleh kosong',
                'txt_password.required'     =>'Kata Sandi tidak boleh kosong'
            ]);

            if ($validator->fails()){
                DB::rollback();
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('login_gagal', 'Login gagal, Silahkan dicoba kembali');
            }

            $admin = Admin::where('admin_email', $request->txt_email)
            ->first();
            if($admin){

                // jika not aktif
                if($admin->status == 2){
                    return redirect('/admin/login')->with('login_gagal', 'Akun Anda Sudah Tidak Aktif');
                }
                else{

                    if (Hash::check($request->txt_password, $admin->password)) {
                        Auth::guard('admin')->login($admin);
                        return redirect()->to('/admin/dashboard');
                    }
                    else{
                        return redirect('/admin/login')->with('login_gagal', 'Kata Sandi Anda Salah, Silahkan Dicoba Kembali');
                    }
                }
            }
            
            DB::commit();
            return redirect('/admin/login')->with('login_gagal', 'Akun Tidak Ditemukan');
        }catch (\Exception $e) {
            DB::rollback();
            return redirect('/admin/login')->with('login_gagal', 'Terjadi kesalahan: '.$e->getMessage());
        }   
    }

    public function actionLogout(){        
        Auth::guard('admin')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
