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
	public $relational_fields = ['belongsTo', 'belongsToMany', 'hasOne', 'hasMany', 'manyToMany'];
	public $pivot_or_child = ['belongsToMany', 'hasOne', 'hasMany', 'manyToMany'];

	// ===> Limit prevents recursive functions from entering infinite loop
	public $limit = 6;

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

	/**
	 * @param $identifier
	 * @param string $method
	 * @return mixed
	 */
	public function reproduce_identifier($identifier, $method = "index")
	{
		$reproduced_fields = $identifier->fields();

		foreach ($reproduced_fields as $key => $value)
		{
			if (in_array($value['type'], $this->relational_fields, true))
			{
				if (@$value['available_in'] && in_array($method, $value['available_in'], true))
				{
					$reproduced_fields = $this->{$value['type']."Reproduce"}($reproduced_fields, $key, "create");
				}
			}
		}

		return $reproduced_fields;
	}

	/**
	 * Reproducing belongs to filed to have the selectable data in it
	 *
	 * @param $identifier_fields , Identifier fields
	 * @param $key , is the key for the identifier field
	 * @param bool $load_data , when assigned, it will load the data for the given belongsTo field identifier
	 * @return mixed returns reproduced identifier
	 */
	public function belongsToReproduce($identifier_fields, $key, $load_data = false)
	{
		$identifier = new $identifier_fields[$key]['identifier'];

		if ($load_data)
		{
			$data = $identifier->model::all();

			$identifier_fields[$key]['data'] = $data;
		}

		$identifier_fields[$key]['title'] = $identifier->title;

		return $identifier_fields;
	}

	public function hasManyReproduce($identifier_fields, $key, $method = "create")
	{
		$sub_identifier = new $identifier_fields[$key]['identifier'];

		$reproduced_fields = $sub_identifier->fields();

		if ($this->limit !== 0)
		{
			$this->limit = $this->limit - 1;

			foreach ($reproduced_fields as $field_key => $field_value)
			{
				if (in_array($field_value['type'], $this->relational_fields, true))
				{
					if (@$field_value['available_in'] && in_array($method, $field_value['available_in'], true))
					{
						$reproduced_fields = $this->{$field_value['type'] . "Reproduce"}($reproduced_fields, $field_key, $method);
					}
				}
			}
		}



		$identifier_fields[$key]['fields'] = $reproduced_fields;

		return $identifier_fields;
	}
}
