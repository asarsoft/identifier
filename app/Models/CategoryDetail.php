<?php

namespace App\Models;

use App\Models\Concerns\GenerateGuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryDetail extends Model
{
	use GenerateGuid, SoftDeletes;
	protected $table = 'category_detail';
	protected $guarded = [];

	public function fields()
	{
		return [
			'model' => 'category_detail',
			'fields' => [
				'id' => [
					'type' => 'number',
					'max' => '1000000',
					'straight_attributes' => 'required',
					'available_in' => ['show'],
				],
				'guid' => [
					'type' => 'text',
					'straight_attributes' => 'required',
					'available_in' => ['show'],
				],
				'language_id' => [
					'type' => 'select',
					'belongs' => 'categories',
					'straight_attributes' => 'required',
					'available_in' => ['index', 'create', 'update', 'edit'],
				],
				'category_id' => [
					'type' => 'select',
					'belongs' => 'categories',
					'straight_attributes' => 'required',
					'available_in' => ['index', 'create', 'update', 'edit'],
				],
				'name' => [
					'type' => 'text',
					'straight_attributes' => 'required',
					'available_in' => ['index', 'create', 'update', 'edit'],
				],
				'description' => [
					'type' => 'text_editor',
					'straight_attributes' => 'required',
					'available_in' => ['create', 'update', 'edit'],
				],
			],
		];
	}
}
