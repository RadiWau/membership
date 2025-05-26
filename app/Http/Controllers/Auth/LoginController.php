<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GeneralController;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        return view('Auth.login');
    }

    public function actionLogin(Request $request){

        try{
        
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'txt_user'=>'required',
                'txt_password'=>'required'
            ], [
                'txt_user.required'     =>'Email / No Hp tidak boleh kosong',
                'txttxt_password_user.required'     =>'Kata Sandi tidak boleh kosong'
            ]);

            if ($validator->fails()){
                DB::rollback();
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('login_gagal', 'Login gagal, Silahkan dicoba kembali');
            }

            $user = User::where('username', $request->txt_user)
            ->orWhere('no_hp', $request->txt_user)
            ->first();

            if($user){

                // Tidak Aktif
                if($user->status == 1){
                    return redirect('/')->with('login_info', 'Silahkan topup terlebih dahulu, untuk masuk ke sistem ini');
                }

                else if($user->status == 3){
                    return redirect('/')->with('login_info', 'Akun anda sudah tidka aktif');
                }

                // jika expired
                else if($user->status == 4){
                    return redirect('/')->with('login_info', 'Akun anda sudah kadaluarsa');
                }
                
                else{

                    if (Hash::check($request->txt_password, $user->password)) {
                        Auth::login($user);
                        $getIp = new GeneralController();
                        $update = User::where('user_id', $user->user_id)->update(['last_login'=>now(), 'ip_address'=>$getIp->getIPAddress()]);
                        DB::commit();
                        return redirect()->to('/dashboard');
                    }
                    else{
                        return redirect('/')->with('login_failed', 'Kata Sandi Anda Salah, Silahkan Dicoba Kembali');
                    }

                }
               
            }
            
            DB::commit();
            return redirect('/')->with('login_gagal', 'Akun Tidak Ditemukan');
        }catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('login_gagal', 'Terjadi kesalahan: '.$e->getMessage());
        }    
    }




    public function actionLogout(Request $request){
        
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    }
}
