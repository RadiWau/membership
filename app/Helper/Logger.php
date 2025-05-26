<?php

namespace App\Helper;

use Illuminate\Support\Facades\Log;

class Logger
{

    public static function info($message, $action, $modul)
    {
        $message = $message . ' [' . $action . '] ['. $modul .'] | by [' . Actor::name() . ']';
        Log::info($message);
    }

    public static function error($message, $action, $modul)
    {
        $message = "ERROR [" . $action . "] [". $modul ."] | by [". Actor::name() ."] : " . $message;
        Log::error($message);
    }

    public static function notice($message, $action, $modul)
    {
        $message = $message . ' [' . $action . '] ['. $modul .'] | by [' . Actor::name() . ']';
        Log::notice($message);
    }

    public static function debug($message, $action, $modul)
    {
        $message = $message . ' [' . $action . '] ['. $modul .'] | by [' . Actor::name() . ']';
        Log::debug($message);
    }
}
