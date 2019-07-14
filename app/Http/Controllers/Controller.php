<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	public $module_name = 'non_registered';
	public $success = true;
	public $relational_fields = ['belongsTo', 'belongsToMany', 'hasOne', 'hasMany', 'manyToMany'];
	public $pivot_or_child = ['belongsToMany', 'hasOne', 'hasMany', 'manyToMany'];

	// ===> Limit prevents recursive functions from entering infinite loop
	public $limit = 6;
	public $relationships = [];

	/**
	 * @param $action
	 * @return array
	 */
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
	 * @param null $id
	 * @param bool $load_data
	 * @return mixed
	 */
	public function reproduce_identifier($identifier, $method = "index", $id = null, $load_data = true)
	{
		$reproduced_fields = $identifier->fields();

		foreach ($reproduced_fields as $key => $value)
		{
			if (in_array($value['type'], $this->relational_fields, true))
			{
				if (@$value['available_in'] && in_array($method, $value['available_in'], true))
				{
					$reproduced_fields = $this->{$value['type'] . "Reproduce"}($reproduced_fields, $key, "create", $load_data);
				}
			}
		}

		return $reproduced_fields;
	}

	/**
	 * @param $identifier_fields
	 * @param $key
	 * @param string $method
	 * @param bool $load_data
	 * @return mixed
	 */
	public function belongsToReproduce($identifier_fields, $key, $method = 'create', $load_data = false)
	{
		$identifier = new $identifier_fields[$key]['identifier'];

		if ($load_data)
		{
			$data = $identifier->model::all();

			$identifier_fields[$key]['data'] = $data;
		}

		$identifier_fields[$key]['title'] = $identifier->title;

		$identifier_fields[$key]['model'] = $identifier->model;

		return $identifier_fields;
	}

	/**
	 * @param $identifier_fields
	 * @param $key
	 * @param string $method
	 * @param bool $load_data
	 * @return mixed
	 */
	public function hasManyReproduce($identifier_fields, $key, $method = "create", $load_data = true)
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
						$reproduced_fields = $this->{$field_value['type'] . "Reproduce"}($reproduced_fields, $field_key, $method, $load_data);
					}
				}
			}
		}

		$identifier_fields[$key]['fields'] = $reproduced_fields;

		return $identifier_fields;
	}

	/**
	 * child is used when you want to load given child of the given identifier,
	 * and child id is to load a specific child
	 *
	 * @param $identifier
	 * @param $method
	 * @param bool $load_data
	 * @param null $id
	 * @param null $child
	 * @param null $child_id
	 * @return array
	 */
	public function loadIdentifier($identifier, $method, $load_data = false, $id = null, $child = null, $child_id = null)
	{
		$data = null;

		$identifier = new $identifier;

		$identifier_fields['main_identifier'] = [
			'title' => $identifier->title,
			'model' => $identifier->model,
			'fields' => $identifier->fields(),
		];

		foreach ($identifier_fields['main_identifier']['fields'] as $key => $value)
		{
			if (in_array($value['type'], $this->relational_fields, true))
			{
				//Belongs to field should have title available
				if ($value['type'] == 'belongsTo' && @$value['available_in'] && in_array($method, $value['available_in'], true))
				{
					$this->relationships = [$value['method']];

					$identifier_fields['main_identifier']['fields'] = $this->belongsToReproduce($identifier_fields['main_identifier']['fields'], $key, 'index', false);
				}

				$this->relationships[] = $value['method'];

				$sub_identifier = $this->relationalIdentifier($value);

				$identifier_fields['sub_identifier'][] = $sub_identifier;
			}
		}

		if ($load_data)
		{
			$data = $this->identifierData($identifier, $this->relationships, $id, $child, $child_id);
		}

		$loaded_identifier = [
			'data' => $data,
			'identifier_fields' => $identifier_fields
		];

		return $loaded_identifier;
	}

	public function identifierData($identifier, $relationships = [], $id = null, $child = null, $child_id = null)
	{
		if ($id == null)
		{
			$data = $identifier->model::with($relationships)->get();
		}

		else
		{
			$data = $identifier->model::with($relationships)->where('id', $id)->first();
		}

		return $data;
	}

	public function relationalIdentifier($field)
	{
		$identifier = new $field['identifier'];

		$field['title'] = $identifier->title;

		$field['model'] = $identifier->model;

		$field['fields'] = $identifier->fields();

		return $field;
	}


	/**
	 * @param $data
	 * @return mixed
	 */
	public function store_and_upload($data)
	{
		if ($data['images'] != null)
		{
			foreach ($data['images'] as $image)
			{
				$path = Storage::disk($image['disk'])->put('', $data['data'][$image['name']]);

				$data['data'][$image['name']] = $path;
			}
		}

		$stored = $data['model']::create($data['data']);

		if ($data['sub_data'] != null)
		{
			foreach ($data['sub_data'] as $sub_data)
			{
				$sub_data['data'][strtolower(class_basename($data['model']) . "_id")] = $stored->id;

				$this->store_and_upload($sub_data);
			}
		}

		return $stored->id;
	}

	/**
	 * @param $identifier
	 * @param Request $data
	 * @return array
	 */
	public function validated_data($identifier, Request $data)
	{
		$images = null;
		$sub_data = null;
		$errors = null;

		$identifier = new $identifier;

		$rules = $identifier->rules();

		$validator = Validator::make($data->all(), $rules);

		foreach ($identifier->fields() as $field_key => $field_value)
		{
			if (in_array($field_value['type'], $this->pivot_or_child, true))
			{
				$sub_identifier = new $field_value['identifier'];

				$validate_sub_data = $this->validated_data($sub_identifier, $data);

				$sub_data[] = $validate_sub_data;

				if (@$validate_sub_data['errors'])
				{
					$this->success = false;

					$errors = $errors ? $errors->merge($validate_sub_data['errors']) : $validate_sub_data['errors'];
				}
			}

			if ($field_value['type'] == "image")
			{
				$images[] = array_merge($field_value, ['name' => $field_key]);
			}
		}

		if (!$this->success || $validator->fails())
		{
			$this->success = false;

			$errors = $errors ? $errors->merge($validator->errors()) : $validator->errors();

			$storable['errors'] = $errors;
		}

		else
		{
			$storable = [
				'errors' => null,
				'model' => $identifier->model,
				'images' => $images,
				'data' => $data->only(array_keys($rules)),
				'sub_data' => $sub_data
			];
		}

		return $storable;
	}

}
