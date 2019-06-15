<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $module_name = 'non_registered';
    function toast_message($action)
    {
        $toast_messages = [
            'message' => trans('message.' . $this->module_name . '_' . $action . '_success'),
            'title' => trans('app.name')
        ];

        return $toast_messages;
    }
}
