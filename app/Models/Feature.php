<?php

namespace App\Models;

use App\Models\Concerns\GenerateGuid;
use App\Traits\Loggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feature extends Model
{
	use GenerateGuid, SoftDeletes, Loggable;
	protected $guarded = [];

	/**
	 * Detail in the user's language
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function detail()
	{
		$language = Language::find(session('language_id'));
		return $this->hasOne(FeatureDetail::class)->where('language_id', $language->id);
	}

	/**
	 * All of the details
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function details()
	{
		return $this->hasMany(FeatureDetail::class);
	}

	/**
	 * The category of feature with it's detail
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function category()
	{
		return $this->belongsTo(Category::class)->with('detail');
	}

	/**
	 * The trashed detail
	 * @return mixed
	 */
	public function trashed_detail()
	{
		$language = Language::find(session('language_id'));
		return $this->hasOne(FeatureDetail::class)->withTrashed()->where('language_id', $language->id);
	}

	/**
	 * All of it's Trashed Details
	 * @return mixed
	 */
	public function trashed_details()
	{
		return $this->hasMany(FeatureDetail::class)->withTrashed();
	}

	public function fields()
	{
		return [
			'model' => 'feature',
			'fields' => [
				'icon' => [
					'type' => 'image',
					'disk' => 'feature',
					'straight_attributes' => 'required',
					'available_in' => ['index', 'create', 'update', 'edit'],
				],
				'category_id' => [
					'type' => 'select',
					'belongs' => 'categories',
					'straight_attributes' => 'required',
					'available_in' => ['index', 'create', 'update', 'edit'],
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
				],
				'approximate_time' => [
					'type' => 'number',
					'max' => '1000000',
					'straight_attributes' => 'required',
				],
				'difficulty' => [
					'type' => 'number',
					'max' => '1000000',
					'straight_attributes' => 'required',
				],
				'priority' => [
					'type' => 'number',
					'max' => '1000000',
					'straight_attributes' => 'required',
				],
			],
			'sub_models' => [
				$this->sub_models()
			]
		];
	}

	/**
	 * Returns sub models of the given object, which than allows us
	 * to display in wherever we need
	 * @return array
	 */
	function sub_models()
	{
		$sub_model = new FeatureDetail();
		return [
			'feature_detail' => [
				'title' => 'name',
				'fields' => $sub_model->fields(),
				'available_in' => ['index', 'create', 'update', 'delete'],
			]
		];
	}
}
