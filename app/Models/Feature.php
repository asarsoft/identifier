<?php

namespace App\Models;

use App\Models\FeatureDetail;
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
}
