<?php

namespace App\Http\Controllers;

use App\Helper\Logger;
use App\Http\Controllers\Controller;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Bank;
use App\Traits\AjaxResponseTrait;
use Exception;
use Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Encryption\DecryptException;

class GeneralController extends Controller
{
    use AjaxResponseTrait;

    public function getProvinsi(Request $request){
        try {
            if(isset($request->txt_provinsi)){
                $Provinsi = Provinsi::where('id', $request->txt_provinsi)->get(['id', 'name']);
            }else{
                $Provinsi = Provinsi::get(['id', 'name']);
            }
           
            
            echo "[";
            $i = 0;
            foreach($Provinsi as $data){
                if($i >0){
                    echo ",\r\n";
                }
                echo "{\"id\"  : \"$data->id\", \"text\":\"$data->name \"}";
                $i++;
            }

            echo "]";

        }catch (Exception $e) {

            return $e;
        }
    }

    public function getKabupaten(Request $request){
        try {

            $Kabupaten = Kabupaten::where('provinsi_id', $request->prov_id)->get(['id', 'name']);    
            
            echo "[";
            $i = 0;
            foreach($Kabupaten as $data){
                if($i >0){
                    echo ",\r\n";
                }
                echo "{\"id\"  : \"$data->id\", \"text\":\"$data->name \"}";
                $i++;
            }

            echo "]";

        }catch (Exception $e) {

            return $e;
        }
    }

    public function getKecamatan(Request $request){
        try {
            $Kecamatan = Kecamatan::where('kabupaten_id', $request->kab_id)->get(['id', 'name']);    

            echo "[";
            $i = 0;
            foreach($Kecamatan as $data){
                if($i >0){
                    echo ",\r\n";
                }
                echo "{\"id\"  : \"$data->id\", \"text\":\"$data->name \"}";
                $i++;
            }

            echo "]";

        }catch (Exception $e) {

            return $e;
        }
    }

    public function getKelurahan(Request $request){
        try {

            $Kelurahan = Kelurahan::where('kecamatan_id', $request->kec_id)->get(['id', 'name']);    

            echo "[";
            $i = 0;
            foreach($Kelurahan as $data){
                if($i >0){
                    echo ",\r\n";
                }
                echo "{\"id\"  : \"$data->id\", \"text\":\"$data->name \"}";
                $i++;
            }

            echo "]";

        }catch (Exception $e) {

            return $e;
        }
    }

    public function getBank(Request $request){
        try {

            $Bank = Bank::get(['id', 'nama_bank']);    

            echo "[";
            $i = 0;
            foreach($Bank as $data){
                if($i >0){
                    echo ",\r\n";
                }
                echo "{\"id\"  : \"$data->id\", \"text\":\"$data->nama_bank \"}";
                $i++;
            }

            echo "]";

        }catch (Exception $e) {

            return $e;
        }
    }

    public function getIPAddress() {
		//whether ip is from the share internet
		if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		}
		//whether ip is from the proxy
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		//whether ip is from the remote address
		else{
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}

    public function encrypt($string){

		
        $encrypted = encrypt($string);
		return $encrypted;

	}

	public function decrypt($string){
		$decrypt = decrypt($string);
        return $decrypt;
	}

    public function paketLevel($value){
        $paket = "";
        if($value == 1){
            $paket = "SILVER";
        }else{
            $paket = "GOLD";
        }

        return $paket;
    }

    public function paketPrice($paket, $regis=null){
        $price = 0;
        if($paket == 1){
            $price = "110.000";
        }else{
            if($regis==null){
                $price = "610.000";
            }else{
                $price = "510.000";
            }
        }

        return $price;
    }

    function cleanNumber($num) {
        return str_replace('.', '', (string)$num);
    }

    
}
