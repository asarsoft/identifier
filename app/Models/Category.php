<?php

namespace App\Models;

use App\Models\Concerns\GenerateGuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
	use GenerateGuid, SoftDeletes;
	protected $guarded = [];
	protected $table = 'categories';

	public function detail()
	{
		$language = Language::find(session('language_id'));
		return $this->hasOne(CategoryDetail::class)->where('language_id', $language->id);
	}

	/**
	 * All of the details
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function details()
	{
		return $this->hasMany(CategoryDetail::class);
	}

	/**
	 * The category of feature with it's detail
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function category()
	{
		return $this->belongsTo(Category::class, 'parent_id', 'id')->with('detail');
	}

	/**
	 * The trashed detail
	 * @return mixed
	 */
	public function trashed_detail()
	{
		$language = Language::find(session('language_id'));
		return $this->hasOne(CategoryDetail::class)->withTrashed()->where('language_id', $language->id);
	}


	/**
	 * All of it's Trashed Details
	 * @return mixed
	 */
	public function trashed_details()
	{
		return $this->hasMany(FeatureDetail::class)->withTrashed();
	}
}
