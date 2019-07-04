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
			'model' => 'feature_detail',
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
				'feature_id' => [
					'type' => 'select',
					'belongs' => 'feature',
					'identifier' => FeatureIdentifier::class,
					'straight_attributes' => 'required',
					'available_in' => ['index', 'show', 'edit'],
				],
				'language_id' => [
					'type' => 'select',
					'belongs' => 'language',
					'identifier' => LanguageIdentifier::class,
					'straight_attributes' => 'required',
					'available_in' => ['index', 'create', 'show', 'edit'],
				],
				'name' => [
					'type' => 'text',
					'straight_attributes' => 'required',
					'available_in' => ['index', 'create', 'show', 'edit'],
				],
				'description' => [
					'type' => 'text_editor',
					'straight_attributes' => 'required',
					'available_in' => ['create', 'show', 'edit'],
				],
				'feature_type' => [
					'type' => 'text',
					'straight_attributes' => 'required',
					'available_in' => ['index', 'create', 'show', 'edit'],
				],
				'deleted_at' => [
					'type' => 'date',
					'straight_attributes' => 'required',
					'available_in' => ['index', 'create', 'show', 'edit'],
				],
				'created_at' => [
					'type' => 'date',
					'straight_attributes' => 'required',
					'available_in' => ['index', 'create', 'show', 'edit'],
				],
				'updated_at' => [
					'type' => 'date',
					'straight_attributes' => 'required',
					'available_in' => ['index', 'create', 'show', 'edit'],
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
				'available_in' => ['index', 'create', 'show', 'delete'],
			]
		];
	}
}