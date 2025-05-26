<?php

namespace App\Http\Controllers;

use App\Helper\Logger;
use App\Http\Controllers\Controller;
use App\Models\LogsMember;
use App\Traits\AjaxResponseTrait;
use Exception;
use Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LogsMemberController extends Controller
{
    use AjaxResponseTrait;

    public function Insert($data){
        try {
            
            $insertLogs = new LogsMember;
            $insertLogs->user_id    = $data['Member'];
            $insertLogs->aktifitas  = $data['AktifitasiTipe'].' '. $data['aktifitas'];
            $insertLogs->save();


        }catch (Exception $e) {

            return $e;
        }
    }
}
