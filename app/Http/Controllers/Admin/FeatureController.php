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
		$validated = $this->validated_data($this->identifier, $request, true);

		if ($this->success === true)
		{
			$id = $this->store_and_upload($validated);
		}

		else
		{
			$errors = null;

			foreach ($validated as $item)
			{
				if ($item['errors'] != null)
				{
					$errors = $errors ? $errors : $item['errors'];

					$errors->merge($item['errors']);
				}
			}

			return redirect()->back()->withInput($request->all())->withErrors($errors);
		}

		return redirect()->route($this->show_route, $id);
	}

	/**
	 * @param $identifier
	 * @param Request $data
	 * @param bool $primary
	 * @return array
	 */
	public function validated_data($identifier, Request $data, $primary = false)
	{
		$identifier = new $identifier;

		$images = null;

		$rules = $identifier->rules();

		$validator = Validator::make($data->all(), $rules);

		foreach ($identifier->fields() as $field_key => $field_value)
		{
			if (in_array($field_value['type'], $this->pivot_or_child, true))
			{
				$sub_identifier = new $field_value['identifier'];

				$storable = array_values($this->validated_data($sub_identifier, $data));
			}

			elseif ($field_value['type'] == "image")
			{
				$images[] = array_merge($field_value, ['name' => $field_key]);
			}
		}

		if ($validator->fails())
		{
			$this->success = false;

			$storable[] = ['errors' => $validator->errors()];
		}

		else
		{
			$storable[] = [
				'primary' => $primary,
				'errors' => null,
				'model' => $identifier->model,
				'images' => $images,
				'data' => $data->only(array_keys($rules))
			];
		}

		return $storable;
	}

	public function store_and_upload($data)
	{
		$id = null;

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
				$record['data'][strtolower(class_basename($record['model'])) . '_id'] = $id;

				$record['model']::create([$record['data']]);
			}

			else
			{
				$stored = $record['model']::create([$record['data']]);

				$id = $stored->id;
			}
		}

		return $id;
	}
}
