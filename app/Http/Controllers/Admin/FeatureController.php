<?php

namespace App\Http\Controllers\Admin;

use App\Models\FeatureDetail;
use App\Models\Category;
use App\Models\Feature;
use App\Models\Language;
use Illuminate\Http\Request;

class FeatureController extends CrudController
{
	public $module_name = 'feature';
	public $model = Feature::class;

	public $module_foreign = 'feature_id';

	public $relationships = ['details', 'category'];
	public $child_relations = ['details'];

	public $trashed_child = ['trashed_detail'];
	public $trashed_children = ['trashed_details'];

	public $cover = true;

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

	public $index_view = 'admin_views.crud.feature.index';
	public $recycle_view = 'admin_views.crud.feature.recycle';
	public $show_view = 'admin_views.crud.feature.show';
	public $create_view = 'admin_views.crud.feature.create';
	public $edit_view = 'admin_views.crud.feature.edit';

	public $show_route = "show-feature";

	/**
	 * Update the Feature itself
	 * @param $id
	 * @param Request $request
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function update($id, Request $request)
	{
		$feature = Feature::find($id);
		if ($feature)
		{
			$feature_validator = $request->validate([
				'category_id' => 'required|numeric',
				'min_price' => 'nullable|numeric|max:1000000',
				'max_price' => 'nullable|numeric|max:1000000',
				'approximate_time' => 'required|numeric|max:1000000',
				'difficulty' => 'required|numeric|max:100|min:0',
				'priority' => 'required|numeric|max:100000',
			]);


			if ($feature->update($feature_validator))
			{
				$toast_messages = $this->toast_message('delete');

				return view('admin_view.crud.feature.show', ['feature' => $feature])->with(['toast_messages' => $toast_messages]);
			}
		}
	}

	public function edit_detail($id)
	{
		$feature_detail = FeatureDetail::find($id);

		$feature_detail->update([
			'language_id' => $request
		]);
	}

	public function parameters()
	{
		$rules = [
			'feature' => [
				'rules' => [
					'category_id' => 'required|numeric',
					'min_price' => 'nullable|numeric|max:1000000',
					'max_price' => 'nullable|numeric|max:1000000',
					'approximate_time' => 'required|numeric|max:1000000',
					'difficulty' => 'required|numeric|max:100|min:0',
					'priority' => 'required|numeric|max:100000',
				],
				'name' => 'fish',
				'model' => Feature::class,
				'image' => 'icon'
			],
			'feature_detail' => [
				'rules' => [
					'language_id' => 'required',
					'name' => 'required|max:199',
					'description' => 'nullable|max:1000000',
					'feature_type' => 'required|max:199',
				],
				'model' => FeatureDetail::class,
				'sub_model' => true
			],
		];

		return $rules;
	}
}
