<?php

namespace App\Http\Controllers\Member;

use App\Helper\Logger;
use App\Http\Controllers\Controller;
use App\Models\Customers;
use App\Models\User;
use App\Traits\AjaxResponseTrait;
use Exception;
use Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use AjaxResponseTrait;

    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index(){
        return view('Member.index');
    }

    public function profile($id){
        $user = User::where("user_id", $id)->first();
        return view('Member.profile')->with('data', $user);
    }    
    
    public function checkPassword(Request $request){

        $user = User::where('user_id', Auth::guard('web')->user()->user_id)
        ->first();

        if($user){
            if (Hash::check($request->password, $user->password)) {
                return "Pass";
            }
        }
        return "Not Pass";
                   
    }

    public function showAll(Request $request){
        try {

            $customers = Customers::join('users', 'customers.created_by', '=', 'users.id')
            ->get(['customers.*', 'users.name']);           

            Logger::info('All Customers Data', 'showAll', 'Role');

            return $this->success('All Customers Data', $customers);
            
        } catch (Exception $e) {

            Logger::error($e->getMessage(), 'showAll', 'Customers');

            return $this->failure('An error occurred while retrieving Customers data', 500);
        }
    }

    public function show(Request $request)
    {
        try {

            $customer = Customers::where('customer_id', $request->customer_id)->first();

            if ($customer) {
                Logger::info('Show Customer Data', 'show', 'Customer');

                return $this->success('Customer Data', $customer);
            }

            DB::rollback();
            Logger::notice('Customer Not Found', 'show', 'Customer');

            return $this->failure('Customer Not Found', 404);
        } catch (Exception $e) {

            Logger::error($e->getMessage(), 'show', 'Customer');

            return $this->failure('An error occurred while retrieving Customer data', 500);
        }
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            if($request->jump_server == 1){

                $validator = Validator::make($request->all(), [
                    'customer_name' => 'required',
                    'logo_customer' => 'required',
                    'jump_server'   => 'required',
                    'ip_address'    => 'required',
                    'username'      => 'required',
                    'password'      => 'required'
                ], [
                    'customer_name.required' => 'Customer Name cannot be empty',
                    'logo_customer.required' => 'Logo cannot be empty',
                    'jump_server.required' => 'Jump Server cannot be empty',
                    'ip_address.required' => 'Ip Address cannot be empty',
                    'username.required' => 'Username cannot be empty',
                    'password.required' => 'Password Server cannot be empty'
                ]);
            }
            else{

                $validator = Validator::make($request->all(), [
                    'customer_name' => 'required',
                    'logo_customer' => 'required',
                    'jump_server'   => 'required'
                ], [
                    'customer_name.required' => 'Customer Name cannot be empty',
                    'logo_customer.required' => 'Logo cannot be empty',
                    'jump_server.required' => 'Jump Server cannot be empty'
                ]);

            }

            if ($validator->fails()) {

                DB::rollback();
                Logger::notice((string) $validator->errors(), 'store', 'Customers');

                return $this->failure($validator->errors(), 400);
            }

            
            $customers                   = new Customers;
            $customers->customer_name    = $request->customer_name;
            $customers->pic              = $request->pic;
            $customers->email            = $request->email;
            $customers->logo             = "";
            $customers->jump_server      = $request->jump_server;
            $customers->ip_address       = $request->ip_address;
            $customers->username         = $request->username;
            $customers->password         = $request->password;
            $customers->status           = 1;
            $customers->created_by       = Auth::guard('web')->user()->id;
            $customers->created_at       = now();
            $customers->save();

            $pathLogo   = "";
            $file          = $request->file("logo_customer");
            if($request->hasFile("logo_customer")){

                $lampiranPath   	= "customers/".$customers->customer_id.'/logo';
                $filename       	= $customers->customer_id."_".date('dmY His')."." . $file->getClientOriginalExtension();

                $pathProfile   		= $file->storeAs($lampiranPath, $filename, 'public');

                $updatePath     	= Customers::find($customers->customer_id);
                $updatePath->logo= $pathProfile;
                $updatePath->save();

            }


            DB::commit();
            Logger::info('Data Customers Success', 'store', 'Customers');

            return $this->success('Data Customers Success', $customers);
        } catch (Exception $e) {

            DB::rollback();
            Logger::error($e->getMessage(), 'store', 'Customers');

            return $this->failure('An Error Occurred While Updating Customers Data', 500);
        }
    }

    public function update(Request $request)
    {
        try {

            DB::beginTransaction();
            if($request->jump_server == 1){

                $validator = Validator::make($request->all(), [
                    'customer_name' => 'required',
                    'jump_server'   => 'required',
                    'ip_address'    => 'required',
                    'username'      => 'required',
                    'password'      => 'required'
                ], [
                    'customer_name.required' => 'Customer Name cannot be empty',
                    'jump_server.required' => 'Jump Server cannot be empty',
                    'ip_address.required' => 'Ip Address cannot be empty',
                    'username.required' => 'Username cannot be empty',
                    'password.required' => 'Password Server cannot be empty'
                ]);
            }
            else{

                $validator = Validator::make($request->all(), [
                    'customer_name' => 'required',
                    'jump_server'   => 'required'
                ], [
                    'customer_name.required' => 'Customer Name cannot be empty',
                    'jump_server.required' => 'Jump Server cannot be empty'
                ]);

            }

            if ($validator->fails()) {

                DB::rollback();
                Logger::notice((string) $validator->errors(), 'Update', 'Customers');

                return $this->failure($validator->errors(), 400);
            }


            $customer = Customers::find($request->customer_id);
            
            if ($customer) {

                $customer->customer_name    = $request->customer_name;
                $customer->pic              = $request->pic;
                $customer->email            = $request->email;
                $customer->jump_server      = $request->jump_server;

                if($request->jump_server == 1){
                    $customer->ip_address       = $request->ip_address;
                    $customer->username         = $request->username;
                    $customer->password         = $request->password;
                }else{
                    $customer->ip_address       = "";
                    $customer->username         = "";
                    $customer->password         = "";
                }
                
                $customer->updated_at       = now();
                $customer->save();

                $pathLogo       = "";
                $file           = $request->file("logo_customer");
                if($request->hasFile("logo_customer")){

                    $lampiranPath   	= "customers/".$customer->customer_id.'/logo';
                    $filename       	= $customer->customer_id."_".date('dmY His')."." . $file->getClientOriginalExtension();

                    $pathProfile   		= $file->storeAs($lampiranPath, $filename, 'public');

                    $updatePath     	= Customers::find($customer->customer_id);
                    $updatePath->logo= $pathProfile;
                    $updatePath->save();

                }

                DB::commit();
                Logger::info('Customer Data Updated Successfully', 'update', 'Customer');

                return $this->success('Customer Data Updated Successfully', $customer);
            }

            DB::rollback();
            Logger::notice('Customer Not Found', 'update', 'Customer');

            return $this->failure('Customer Not Found', 404);
        } catch (Exception $e) {

            DB::rollback();
            Logger::error($e->getMessage(), 'update', 'Customer');

            return $this->failure('An Error Occurred While Updating Customer Data', 500);
        }
    }

    public function delete(Request $request)
    {
        try {

            DB::beginTransaction();

            $customer = Customers::find($request->customer_id);

            if ($customer) {

                $customer->delete();

                DB::commit();
                Logger::info('Customer Data Deleted Successfully', 'delete', 'Customer');

                return $this->success('Customer Data Deleted Successfully', $customer);
            }

            DB::rollback();
            Logger::notice('Customer Not Found', 'delete', 'Customer');

            return $this->failure('Customer Not Found', 404);
        } catch (Exception $e) {

            DB::rollback();
            Logger::error($e->getMessage(), 'delete', 'CUstomer');

            return $this->failure('An Error Occurred While Deleting Customer Data', 500);
        }
    }

    public function actionProfile(Request $request){
        try {

            DB::beginTransaction();

            $user = User::find(Auth::guard('web')->user()->user_id);

            if ($user) {

                $update     = User::where('user_id', $user->user_id)->update(
                    ['password'=>$password]
                );

                DB::commit();

                return redirect()->to('profile/'.$user->user_id)->with('user_success', 'Data Berhasil Diperbarui');
            }

            DB::rollback();
            return redirect()->to('profile/'.$user->user_id.'')->with('user_gagal', 'Memeber Tidak Ditemukan');
            
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: '.$e->getMessage());
       
        }
    }

    public function actionPassword(Request $request){
        try {

            DB::beginTransaction();

            $user = User::find(Auth::guard('web')->user()->user_id);

            if ($user) {

                $password   = Hash::make($request->txt_pass_baru);
                $update     = User::where('user_id', $user->user_id)->update(['password'=>$password]);
                DB::commit();

                return redirect()->to('profile/'.$user->user_id)->with('user_success', 'Kata Sandi Berhasil Dirubah');
            }

            DB::rollback();
            return redirect()->to('profile/'.$user->user_id.'')->with('user_gagal', 'Memeber Tidak Ditemukan');
            
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: '.$e->getMessage());
       
        }
    }

    

}
