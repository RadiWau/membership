<?php

namespace App\Helper;

use Illuminate\Support\Facades\Auth;

class Actor
{
    public static function name()
    {
        return (Auth::check()) ? Auth::user()->user_name : 'Anonymous';
    }

}
