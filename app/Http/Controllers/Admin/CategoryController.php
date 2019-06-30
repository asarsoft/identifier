<?php

namespace App\Http\Controllers\Admin;

use App\Identifiers\CategoryIdentifier;
use App\Models\Category;
use App\Models\CategoryDetail;
use App\Models\Language;

class CategoryController extends CrudController
{
	public $module_name = 'category';

	public $identifier = CategoryIdentifier::class;
	
	public $relationships = ['details', 'category'];
	public $child_relations = ['details'];

	public $trashed_child = ['trashed_detail'];
	public $trashed_children = ['trashed_details'];

//	public $index_view = 'admin_views.crud.category.index';
	public $recycle_view = 'admin_views.crud.category.recycle';
	public $show_view = 'admin_views.crud.category.show';
	public $create_view = 'admin_views.crud.category.create';
	public $edit_view = 'admin_views.crud.category.edit';

	public $show_route = "show-category";

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
		'name' => 'category_detail',
		'model' => CategoryDetail::class,
		'parameter' => 'language_id'
	];

	public function parameters()
	{
		return [
			'name' => 'category',
			'model' => Category::class,
			'image' => ['name' => 'icon', 'disk' => 'category'],
			'rules' => [
				'parent_id' => 'nullable|numeric',
				'title' => 'required|max:199',
			],
			'sub_modules' => [
				'category_detail' => [
					'model' => CategoryDetail::class,
					'name' => 'category_details',
					'differ_by' => 'language_id',
					'rules' => [
						'name' => 'required|max:199',
						'description' => 'nullable|max:1000000',
						'language_id' => 'required',
					],
				],
			]
		];
	}
}
