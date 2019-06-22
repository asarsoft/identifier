<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	public $module_name = 'non_registered';
	public $success = true;

	function toast_message($action)
	{
		$toast_messages = [
			[
				'message' => trans('message.' . $this->module_name . '_' . $action . '_success_' . $this->success),
				'title' => trans('app.name')
			]
		];

		return $toast_messages;
	}
}
