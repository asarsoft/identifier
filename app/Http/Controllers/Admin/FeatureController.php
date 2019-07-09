<?php

namespace App\Http\Controllers\Admin;

use App\Identifiers\FeatureIdentifier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class FeatureController extends CrudController
{
	public $identifier = FeatureIdentifier::class;

	public function store(Request $request, $relation = null)
	{
		$identifier = new $this->identifier;

		$identifier_rules = $identifier->rules();

		$identifier_fields = $identifier->fields();

		$sortables = $this->validated_data($this->identifier, $request);

		foreach ($sortables as $storable)
		{
			$success = $storable['model']::create($storable['data']);
			if (!$success)
			{
				return null;
				//log the error
			}
		}

		$validator = Validator::make($request->all(), $identifier_rules);

		if ($validator->fails())
		{
			return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
		}

		$store_data = $request->only(array_keys($identifier_rules));


		foreach ($identifier_fields as $key => $parameters)
		{
			if ($parameters['type'] == 'image' && $request->hasFile($key))
			{
				$path = $request->file($key)->store('', ['disk' => $parameters['disk']]);

				$store_data[$key] = $parameters['disk'] . '/' . $path;
			}
		}

		$identifier->model::create($store_data);

	}

	public function validated_data($identifier, Request $data)
	{
		$identifier = new $identifier;

		$rules = $identifier->rules();

		$validator = Validator::make($data->all(), $rules);

		if ($validator->fails())
		{
			return ['success' => false, 'errors' => $validator->errors()];
		}

		$storable = [];

		foreach ($identifier->fields() as $field_key => $field_value)
		{
			if (in_array($field_value['type'], $this->pivot_or_child, true))
			{
				dd($field_value, $data);
				$storable_data = $this->validated_data($identifier, $data);
				$storable[$storable_data['model']] = $storable_data['data'];
			}
		}

		$storable = ['model' => $identifier->model, 'data' => $data->only(array_keys($rules))];

		return $storable;
	}
}
