<?php
namespace App\Identifiers;

use App\Models\CategoryDetail;

class CategoryIdentifier extends BaseIdentifier
{
	public $title = 'title';

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