<?php

namespace App\Http\Controllers\Admin;

use App\Identifiers\FeatureIdentifier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeatureController extends CrudController
{
	public $identifier = FeatureIdentifier::class;
	public $success = true;

	public function store(Request $request, $relation = null)
	{
		$identifier = new $this->identifier;

		$validated = $this->validated_data($this->identifier, $request);

		if ($this->success === true)
		{

			dd($validated);

		}
		else
		{
			$errors = null;

			foreach ($validated as $item)
			{
				if ($item['errors'] != null)
				{
					$errors = $errors ? $errors : $item['errors'];
					//dd($errors);
					array_merge($errors->getMessageBag()->messages(), $item['errors']->getMessageBag()->messages());
				}
			}

			dd($errors, $validated);

			return redirect()->back()->withInput($request->all())->withErrors($errors);
		}
	}

	public function validated_data($identifier, Request $data)
	{
		$identifier = new $identifier;

		$rules = $identifier->rules();

		$validator = Validator::make($data->all(), $rules);

		foreach ($identifier->fields() as $field_key => $field_value)
		{
			if (in_array($field_value['type'], $this->pivot_or_child, true))
			{
				$sub_identifier = new $field_value['identifier'];

				$storable_data = $this->validated_data($sub_identifier, $data);

				$storable = array_values($storable_data);
			}
		}

		if ($validator->fails())
		{
			$this->success = false;

			$storable[] = ['errors' => $validator->errors()];
		}

		else
		{
			$storable[] = ['errors' => null, 'model' => $identifier->model, 'data' => $data->only(array_keys($rules))];
		}

		return $storable;
	}
}
