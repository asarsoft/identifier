<?php
namespace App\Identifiers;

use App\Models\Feature;

class FeatureIdentifier extends BaseIdentifier
{
	public $title = 'id';
	public $model = Feature::class;

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
				'guid' => [
					'type' => 'text',
					'straight_attributes' => 'required',
					'available_in' => [],
				],
				'category_id' => [
					'type' => 'select',
					'belongs' => 'category',
					'identifier' => CategoryIdentifier::class,
					'options' => 'categories',
					'straight_attributes' => 'required',
					'available_in' => ['index', 'create', 'show', 'edit'],
				],
				'icon' => [
					'type' => 'image',
					'driver' => "feature",
					'straight_attributes' => 'required',
					'available_in' => ['index', 'create', 'show', 'edit'],
				],
				'feature_details' => [
					'type' => 'select',
					'hasOne' => 'feature_details',
					'identifier' => FeatureDetailIdentifier::class,
					'available_in' => ['create', 'show', 'edit'],
				],
				'min_price' => [
					'type' => 'number',
					'max' => '1000000',
					'straight_attributes' => 'required',
					'available_in' => ['index', 'create', 'show', 'edit'],
				],
				'max_price' => [
					'type' => 'number',
					'max' => '1000000',
					'straight_attributes' => 'required',
					'available_in' => ['index', 'create', 'show', 'edit'],
				],
				'approximate_time' => [
					'type' => 'number',
					'max' => '1000000',
					'straight_attributes' => 'required',
					'available_in' => ['index', 'create', 'show', 'edit'],
				],
				'difficulty' => [
					'type' => 'number',
					'max' => '1000000',
					'straight_attributes' => 'required',
					'available_in' => ['index', 'create', 'show', 'edit'],
				],
				'priority' => [
					'type' => 'number',
					'max' => '1000000',
					'straight_attributes' => 'required',
					'available_in' => ['index', 'create', 'show', 'edit'],
				],
			],
		];
	}
}