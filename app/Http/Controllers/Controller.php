<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function toast_message($action){
        return [
            [
                'message' => trans('message.' . $this->module_name . '_'.$action.'_success'),
                'title' => trans('app.name'),
            ]
        ];
    }
}
