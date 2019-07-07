<?php

namespace App\Identifiers;

use App\Models\Language;

class LanguageIdentifier extends BaseIdentifier
{
	public $title = 'name';
	public $model = Language::class;

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
			'name' => [
				'type' => 'text',
				'available_idn' => ['index', 'create', 'show', 'edit']
			],
			'language_code' => [
				'type' => 'text',
				'available_idn' => ['index', 'create', 'show', 'edit']
			],
			'icon' => [
				'type' => 'image',
				'driver' => "language",
				'available_in' => ['index', 'create', 'show', 'edit'],
			],
			'is_featured' => [
				"type" => "select",
				"options" => ["0" => "ban", "1" => "active"],
				'available_in' => ['show', "index"]
			],
			"deleted_at" => [
				"type" => "date",
				"available_in" => ["show"]
			],
			"created_at" => [
				"type" => "date",
				"available_in" => ["show"]
			],
			"updated_at" => [
				"type" => "date",
				"available_in" => ["show", "index"]
			]
		];
	}

	public function rules()
	{
		return [
			'name' => 'required|numeric',
			'language_code' => 'required',
			'icon' => 'nullable|image|max:2048',
			'is_featured' => 'nullable|numeric|max:1000',
		];
	}
}