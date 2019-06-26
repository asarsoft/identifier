<?php
namespace App\Identifiers;

use App\Models\CategoryDetail;

class FeatureIdentifier extends BaseIdentifier
{
	public $title = 'id';

	public function fields()
	{
		return [
			'model' => 'feature',
			'fields' => [
				'icon' => [
					'type' => 'image',
					'straight_attributes' => 'required',
					'available_in' => ['index', 'create', 'update', 'edit'],
				],
				'category_id' => [
					'type' => 'select',
					'belongs' => 'category',
					'options' => 'categories',
					'straight_attributes' => 'required',
					'available_in' => ['index', 'create', 'update', 'edit'],
				],
				'min_price' => [
					'type' => 'number',
					'max' => '1000000',
					'straight_attributes' => 'required',
					'available_in' => ['index', 'create', 'update', 'edit'],
				],
				'max_price' => [
					'type' => 'number',
					'max' => '1000000',
					'straight_attributes' => 'required',
					'available_in' => ['index', 'create', 'update', 'edit'],
				],
				'approximate_time' => [
					'type' => 'number',
					'max' => '1000000',
					'straight_attributes' => 'required',
					'available_in' => ['index', 'create', 'update', 'edit'],
				],
				'difficulty' => [
					'type' => 'number',
					'max' => '1000000',
					'straight_attributes' => 'required',
					'available_in' => ['index', 'create', 'update', 'edit'],
				],
				'priority' => [
					'type' => 'number',
					'max' => '1000000',
					'straight_attributes' => 'required',
					'available_in' => ['index', 'create', 'update', 'edit'],
				],
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