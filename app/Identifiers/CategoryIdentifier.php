<?php

namespace App\Identifiers;

use App\Models\Category;
use App\Models\CategoryDetail;

class CategoryIdentifier extends BaseIdentifier
{
	public $title = 'title';
	public $model = Category::class;

	public function fields()
	{
		return [
			'id' => [
				'type' => 'number',
				'available_in' => ['show'],
			],
			'icon' => [
				'type' => 'image',
				'disk' => 'category',
				'straight_attributes' => 'required',
				'available_in' => ['index', 'create', 'show', 'edit'],
			],
			'guid' => [
				'type' => 'text',
				'available_in' => ['show'],
			],
			'parent_id' => [
				'type' => 'belongsTo',
				'method' => 'category',
				'identifier' => CategoryIdentifier::class,
				'available_in' => ['index', 'create', 'show', 'edit'],
			],
			'title' => [
				'type' => 'text',
				'available_in' => ['index', 'create', 'show', 'edit'],
			]
		];
	}

	public function rules()
	{
		return [
			'title' => 'required|max:199',
			'icon' => 'nullable|image|max:2048',
			'parent_id' => 'nullable|numeric|max:100000000',
		];
	}
}