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
}
