<?php

namespace App\Traits;

trait AjaxResponseTrait {

    public function success($message, $data = [], $code = 200)
    {
        return response([
            'code'    => $code,
            'status'  => TRUE,
            'data'    => $data,
            'message' => $message,
        ], $code);
    }

    protected function failure($message, $code = 422)
    {
        return response([
            'code'    => $code,
            'status'  => FALSE,
            'message' => $message,
        ], $code);
    }

}
