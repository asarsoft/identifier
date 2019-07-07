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
			'id' => [
				'type' => 'number',
				'available_in' => ['index', 'show'],
			],
			'guid' => [
				'type' => 'text',
				'available_in' => ['show'],
			],
			'category_id' => [
				'type' => 'belongsTo',
				'method' => 'category',
				'identifier' => CategoryIdentifier::class,
				'available_in' => ['index', 'create', 'show', 'edit'],
			],
			'icon' => [
				'type' => 'image',
				'driver' => "feature",
				'available_in' => ['index', 'create', 'show', 'edit'],
			],
			'min_price' => [
				'type' => 'number',
				'available_in' => ['index', 'create', 'show', 'edit'],
			],
			'max_price' => [
				'type' => 'number',
				'available_in' => ['index', 'create', 'show', 'edit'],
			],
			'approximate_time' => [
				'type' => 'number',
				'available_in' => ['index', 'create', 'show', 'edit'],
			],
			'difficulty' => [
				'type' => 'number',
				'available_in' => ['index', 'create', 'show', 'edit'],
			],
			'priority' => [
				'type' => 'number',
				'available_in' => ['index', 'create', 'show', 'edit'],
			],
			'feature_details' => [
				'type' => 'belongsTo',
				'method' => 'feature_details',
				'identifier' => FeatureDetailIdentifier::class,
				'available_in' => ['create', 'show', 'edit'],
			],
		];
	}
}