<?php

namespace App\Http\Controllers\Admin;

use App\Models\FeatureDetail;
use App\Models\Category;
use App\Models\Feature;
use App\Models\Language;

class FeatureController extends CrudController
{
	public $module_name = 'feature';
	public $model = Feature::class;

	public $module_foreign = 'feature_id';

	public $relationships = ['details', 'category'];
	public $child_relations = ['details'];

	public $trashed_child = ['trashed_detail'];
	public $trashed_children = ['trashed_details'];

//	public $index_view = 'admin_views.crud.feature.index';
	public $recycle_view = 'admin_views.crud.feature.recycle';
	public $show_view = 'admin_views.crud.feature.show';
	public $create_view = 'admin_views.crud.feature.create';
	public $edit_view = 'admin_views.crud.feature.edit';

	public $show_route = "show-feature";

	public $manage_objects = [
		[
			'model' => Category::class,
			'sub_models' => ['detail'],
			'model_name' => 'categories'
		],
		[
			'model' => Language::class,
			'sub_models' => [],
			'model_name' => 'languages'
		]
	];

	public $child = [
		'name' => 'feature_detail',
		'model' => FeatureDetail::class,
		'parameter' => 'language_id'
	];

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
