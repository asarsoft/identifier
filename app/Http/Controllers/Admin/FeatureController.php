<?php

namespace App\Http\Controllers\Admin;

use App\Identifiers\FeatureIdentifier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeatureController extends CrudController
{
	public $identifier = FeatureIdentifier::class;
	public $success = true;

	/**
	 * @param Request $request
	 * @param null $relation
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
	 */
	public function store(Request $request, $relation = null)
	{
		$validated = $this->validated_data($this->identifier, $request);

		if ($this->success === true)
		{
			$id = $this->store_and_upload($validated);
		}

		else
		{
			return redirect()->back()->withInput($request->all())->withErrors($validated['errors']);
		}

		return redirect()->route($this->show_route, $id);
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

	public function store_and_upload($data)
	{
		$id = null;

		dd($data);

		foreach ($data as $record)
		{
			if ($record['images'] != null)
			{
				foreach ($record['images'] as $image)
				{
					$image_field_name = $record['images'][$image['name']];

					$path = $request->file($record['data'][$image_field_name])->store('', [
						'disk' => $image['disk']
					]);

					$record['data'][$image_field_name] = $path;
				}
			}

			if (!$record['primary'])
			{
				$record['data'][$primary_key] = $id;

				$record['model']::create($record['data']);
			}

			else
			{
				$stored = $record['model']::create($record['data']);

				$id = $stored->id;
			}
		}

		return $id;
	}
}
