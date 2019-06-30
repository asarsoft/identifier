<?php
namespace App\Identifiers;

use App\Models\Feature;
use App\Models\FeatureDetail;

class FeatureIdentifier extends BaseIdentifier
{
	public $title = 'title';
	public $model = Feature::class;
	public $relationships = ['details', 'category'];

	public function fields()
	{
		return [
			'model' => 'feature',
			'fields' => [
				'id' => [
					'type' => 'number',
					'straight_attributes' => 'required',
					'available_in' => ['index'],
				],
				'icon' => [
					'type' => 'image',
					'straight_attributes' => 'required',
					'available_in' => ['index', 'create', 'update', 'edit'],
				],
				'category_id' => [
					'type' => 'select',
					'belongs' => 'category',
					'identifier' => CategoryIdentifier::class,
					'options' => 'categories',
					'straight_attributes' => 'required',
					'available_in' => ['index', 'create', 'update', 'edit'],
				],
				'details' => [
					'type' => 'select',
					'options' => 'details',
					'straight_attributes' => 'required',
					'available_in' => ['create', 'update', 'edit'],
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
		$sub_model = new FeatureDetail();
		return [
			'feature_detail' => [
				'fields' => $sub_model->fields(),
				'available_in' => ['index', 'create', 'update', 'delete'],
			]
		];
	}
}