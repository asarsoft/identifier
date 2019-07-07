<?php

namespace App\Http\Controllers\Admin;

use App\Identifiers\FeatureIdentifier;

class FeatureController extends CrudController
{
	public $identifier = FeatureIdentifier::class;

	/**
	 * this is the create view method
	 * @param $relation
	 * @return mixed
	 */
	public function create($relation = null)
	{
		$identifier = new $this->identifier;

		$reproduced_fields = $this->reproduce_create($identifier);

		dd($reproduced_fields);

		return view('default.create')->with(['fields' => $identifier_fields]);
	}

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

	public function reproduce_create($identifier)
	{
		$reproduced_fields = $identifier->fields();

		foreach ($reproduced_fields as $key => $value)
		{
			if (in_array($value['type'], $this->relational_fields, true))
			{
				if (@$value['available_in'] && in_array('create', $value['available_in'], true))
				{
					$reproduced_fields = $this->{$value['type']."Reproduce"}($reproduced_fields, $key, "create");
				}
			}
		}

		return $reproduced_fields;
	}


	//	public function parameters()
	//	{
	//		return [
	//			'name' => 'feature',
	//			'model' => Feature::class,
	//			'image' => ['name' => 'icon', 'disk' => 'feature'],
	//			'rules' => [
	//				'category_id' => 'required|numeric',
	//				'min_price' => 'nullable|numeric|max:1000000',
	//				'max_price' => 'nullable|numeric|max:1000000',
	//				'approximate_time' => 'required|numeric|max:1000000',
	//				'difficulty' => 'required|numeric|max:100|min:0',
	//				'priority' => 'required|numeric|max:100000',
	//			],
	//			'sub_modules' => [
	//				'feature_detail' => [
	//					'model' => FeatureDetail::class,
	//					'name' => 'feature_details',
	//					'differ_by' => 'language_id',
	//					'rules' => [
	//						'language_id' => 'required',
	//						'name' => 'required|max:199',
	//						'description' => 'nullable|max:1000000',
	//						'feature_type' => 'required|max:199',
	//					],
	//				],
	//			]
	//		];
	//	}

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
