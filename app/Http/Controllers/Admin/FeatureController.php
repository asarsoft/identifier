<?php

namespace App\Http\Controllers\Admin;

use App\Identifiers\FeatureIdentifier;
use App\Models\FeatureDetail;
use App\Models\Feature;

class FeatureController extends CrudController
{
	public $identifier = FeatureIdentifier::class;

	public function index()
	{
		$identifier = new $this->identifier;

		$reproduced_fields = $identifier->fields();

		foreach ($reproduced_fields as $key => $value)
		{
			if ($value['type'] == 'belongsTo' && @$value['available_in'] && in_array('index', $value['available_in'], true))
			{
				$reproduced_fields = $this->belongsToReproduce($reproduced_fields, $key);
			}
		}

		$data = $identifier->model::all();

		return view($this->index_view)->with([
			'model' => strtolower(class_basename($identifier->model)),
			'data' => $data,
			'identifier' => $identifier,
			'fields' => $reproduced_fields
		]);
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

	//	public function create()
	//	{
	//		$identifier = new $this->identifier;
	//
	//		$identifier_fields = $identifier->fields();
	//
	//		foreach ($identifier_fields['fields'] as $key => $value)
	//		{
	//			if (@$value['belongs'] && in_array('create', $value['available_in'], true))
	//			{
	//				$field_identifier = new $value['identifier'];
	//
	//				$identifier_fields['fields'][$key]['records'] = $field_identifier->model::all();
	//			}
	//
	//			elseif (@$value['hasOne'] && in_array('create', $value['available_in'], true))
	//			{
	//				$field_identifier = new $value['identifier'];
	//
	//				$identifier_fields['fields'][$key]['fields'] = $field_identifier->fields();
	//			}
	//		}
	//
	//		dd($identifier_fields);
	//
	//		return view('default.create')->with(['fields' => $identifier_fields]);
	//	}

	public function parameters()
	{
		return [
			'name' => 'feature',
			'model' => Feature::class,
			'image' => ['name' => 'icon', 'disk' => 'feature'],
			'rules' => [
				'category_id' => 'required|numeric',
				'min_price' => 'nullable|numeric|max:1000000',
				'max_price' => 'nullable|numeric|max:1000000',
				'approximate_time' => 'required|numeric|max:1000000',
				'difficulty' => 'required|numeric|max:100|min:0',
				'priority' => 'required|numeric|max:100000',
			],
			'sub_modules' => [
				'feature_detail' => [
					'model' => FeatureDetail::class,
					'name' => 'feature_details',
					'differ_by' => 'language_id',
					'rules' => [
						'language_id' => 'required',
						'name' => 'required|max:199',
						'description' => 'nullable|max:1000000',
						'feature_type' => 'required|max:199',
					],
				],
			]
		];
	}

	/**
	 * Fields are used for indexing, showing, creating, and updating records
	 *
	 * ---------------------------------------------------type----------------------------------------------------------
	 * ===> type: Each type has it's own component
	 *
	 * ---------------------------------------------------image---------------------------------------------------------
	 * ===> image: image will load the image in index, show, edit views, and will return editable field in create
	 *  and edit views
	 *
	 * -------------------------------------------------belongs_to------------------------------------------------------
	 * ===> belongs_to: is used when the type is select, it means the record belongs to the given module
	 *
	 * ---------------------------------------------------text----------------------------------------------------------
	 * ===> belongs_to: is a regular input field with type of text
	 *
	 * ---------------------------------------------------number--------------------------------------------------------
	 * ===> number: when a field is number, it can have min, max fields
	 *
	 * --------------------------------------------------textarea-------------------------------------------------------
	 * ===> textarea: textarea field is not supposed to be shown in the index page but it should be shown in the show
	 * page.
	 *
	 * ---------------------------------------------straight_attributes-------------------------------------------------
	 * ===> straight_attributes: are inserted in the tag directly, example below:
	 * <input type="{{ $records->fields['type'] }}" {{ $records->fields['straight_attributes'] }}>
	 *
	 * ===> above code will execute the html below
	 * <input type="text" required>
	 */
}
