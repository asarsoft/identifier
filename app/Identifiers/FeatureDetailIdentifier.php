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
				'available_in' => ['index', 'show', 'edit', 'create'],
			],
			'language_id' => [
				'type' => 'belongsTo',
				'method' => 'language',
				'identifier' => LanguageIdentifier::class,
				'available_in' => ["index", "create", "edit", "show"],
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
				'available_in' => ['index', 'show'],
			],
			'created_at' => [
				'type' => 'date',
				'available_in' => ['index', 'show'],
			],
			'updated_at' => [
				'type' => 'date',
				'available_in' => ['index', 'show'],
			],
		];
	}

	public function rules()
	{
		return [
			'feature_id' => 'nullable',
			'language_id' => 'required|numeric|max:199',
			'name' => 'required|max:199',
			'description' => 'required|max:1000000',
			'feature_type' => 'required|max:199',
		];
	}
}