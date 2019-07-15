<?php

namespace App\Models;

use App\Models\Concerns\GenerateGuid;
use App\Traits\Loggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeatureDetail extends Model
{
	use GenerateGuid, SoftDeletes, Loggable;

	protected $table = 'feature_detail';
	protected $guarded = [];

	/**
	 * The category of feature with it's detail
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function feature()
	{
		return $this->belongsTo(Feature::class);
	}

	public function language()
	{
		return $this->belongsTo(Language::class);
	}

}
