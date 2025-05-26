<?php

namespace App\Http\Controllers\Administrator\Role;

use App\Helper\Logger;
use App\Http\Controllers\Controller;
use App\Models\Customers;
use App\Models\Users;
use App\Traits\AjaxResponseTrait;
use Exception;
use Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    use AjaxResponseTrait;

    public function __construct(){
        $this->middleware('auth.admin');
    }
    
    public function index(){
        return view('Administrator.Content.Role.index');
    }
}
