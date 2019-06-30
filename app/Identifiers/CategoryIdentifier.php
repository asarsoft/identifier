<?php

namespace App\Identifiers;

use App\Models\Category;
use App\Models\CategoryDetail;

class CategoryIdentifier extends BaseIdentifier
{
	public $title = 'title';
	public $model = Category::class;
	public $relationships = ['details', 'category'];

	public function fields()
	{
		return [
			'model' => 'category',
			'fields' => [
				'id' => [
					'type' => 'number',
					'max' => '1000000',
					'straight_attributes' => 'required',
					'available_in' => ['show'],
				],
				'icon' => [
					'type' => 'image',
					'straight_attributes' => 'required',
					'available_in' => ['index', 'create', 'update', 'edit'],
				],
				'guid' => [
					'type' => 'text',
					'straight_attributes' => 'required',
					'available_in' => ['show'],
				],
				'parent_id' => [
					'type' => 'select',
					'belongs' => 'category',
					'identifier' => CategoryIdentifier::class,
					'options' => 'categories',
					'straight_attributes' => 'required',
					'available_in' => ['index', 'create', 'update', 'edit'],
				],
				'title' => [
					'type' => 'text',
					'straight_attributes' => 'required',
					'available_in' => ['index', 'create', 'update', 'edit'],
				]
			],
			'sub_models' => [
				$this->sub_models()
			]
		];
	}

	function sub_models()
	{
		$sub_model = new CategoryDetail();
		return [
			'category_detail' => [
				'fields' => $sub_model->fields(),
				'available_in' => ['index', 'create', 'update', 'delete'],
			]
		];
	}
}