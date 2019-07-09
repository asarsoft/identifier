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

		$validator = Validator::make($request->all(), $identifier_rules);

		if ($validator->fails())
		{
			return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
		}

		$store_data = $request->only(array_keys($identifier_rules));


		$identifier_fields = $identifier->fields();

		foreach ($identifier_fields as $key => $parameters)
		{
			if ($parameters['type'] == 'image' && $request->hasFile($key))
			{
				$path = $request->file($key)->store('', ['disk' => $parameters['disk']]);

				$store_data[$key] = $parameters['disk'].'/'.$path;
			}
		}

		$identifier->model::create($store_data);

		dd($request->all(), $identifier_fields, $identifier_rules, $store_data);
	}

	public function reproduce_identifier($identifier, $method = "index")
	{
		$reproduced_fields = $identifier->fields();

		foreach ($reproduced_fields as $key => $value)
		{
			if (in_array($value['type'], $this->relational_fields, true))
			{
				if (@$value['available_in'] && in_array($method, $value['available_in'], true))
				{
					$reproduced_fields = $this->{$value['type'] . "Reproduce"}($reproduced_fields, $key, "create");
				}
			}
		}

		return $reproduced_fields;
	}
}
