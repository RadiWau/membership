<?php

namespace App\Http\Controllers\Administrator\Dashboard;

use App\Helper\Logger;
use App\Http\Controllers\Controller;
use App\Models\MemberPaket;
use App\Traits\AjaxResponseTrait;
use Exception;
// use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
{
    
    public function __construct(){
        $this->middleware('auth.admin');
    }
       
    public function index(){
        return view('Administrator.Content.Dashboard.index');
    }

    public function countMemberPaket(){
        $summarySilver = MemberPaket::where('paket_level', 1)->count();
        $summaryGold = MemberPaket::where('paket_level', 2)->count();
        $data = array(['silver'=>$summarySilver, 'gold'=>$summaryGold]);
        return $data;
    }

}
