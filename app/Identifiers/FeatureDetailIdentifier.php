<?php

namespace App\Identifiers;

use App\Models\FeatureDetail;

class FeatureDetailIdentifier extends BaseIdentifier
{
	public $title = 'name';
	public $model = FeatureDetail::class;

	public function fields()
	{
		return [
			'id' => [
				'type' => 'number',
				'available_in' => ['index'],
			],
			'guid' => [
				'type' => 'text',
				'available_in' => ['index'],
			],
			'feature_id' => [
				'type' => 'belongsTo',
				'method' => 'feature',
				'identifier' => FeatureIdentifier::class,
				'available_in' => ['create', 'index', 'show', 'edit'],
			],
			'language_id' => [
				'type' => 'belongsTo',
				'method' => 'feature',
				'identifier' => LanguageIdentifier::class,
				'available_in' => [],
			],
			'name' => [
				'type' => 'text',
				'available_in' => ['index', 'create', 'show', 'edit'],
			],
			'description' => [
				'type' => 'text_editor',
				'available_in' => ['create', 'show', 'edit'],
			],
			'feature_type' => [
				'type' => 'text',
				'available_in' => ['index', 'create', 'show', 'edit'],
			],
			'deleted_at' => [
				'type' => 'date',
				'available_in' => ['index', 'create', 'show', 'edit'],
			],
			'created_at' => [
				'type' => 'date',
				'available_in' => ['index', 'create', 'show', 'edit'],
			],
			'updated_at' => [
				'type' => 'date',
				'available_in' => ['index', 'create', 'show', 'edit'],
			],
		];
	}
}