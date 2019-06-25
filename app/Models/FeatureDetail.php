<?php

namespace App\Models;

use App\Models\Concerns\GenerateGuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeatureDetail extends Model
{
	use GenerateGuid, SoftDeletes;

	protected $table = 'feature_detail';
	protected $guarded = [];

	public function fields()
	{
		return [
			'id' => [
				'type' => 'number',
				'available_in' => ['index']
			],
			'guid' => [
				'type' => 'text',
				'available_in' => ['index']
			],
			'feature_id' => [
				'type' => 'select',
				'belongs' => 'features',
				'straight_attributes' => 'required',
				'available_in' => ['index', 'create', 'update', 'edit'],
			],
			'language_id' => [
				'type' => 'select',
				'belongs' => 'languages',
				'straight_attributes' => 'required',
				'available_in' => ['index', 'create', 'update', 'edit'],
			],
			'name' => [
				'type' => 'text',
				'straight_attributes' => 'required',
				'available_in' => ['index', 'create', 'update', 'edit'],
			],
			'description' => [
				'type' => 'textarea',
				'available_in' => ['index', 'create', 'update', 'edit'],
			],
			'feature_type' => [
				'type' => 'text',
				'max' => '199',
				'straight_attributes' => 'required',
				'class' => 'badge badge-primary',
				'available_in' => ['index', 'create', 'update', 'edit'],
			],
		];
	}
}
