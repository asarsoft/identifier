<?php

namespace App\Models;

use App\FeatureDetail;
use App\Models\Concerns\GenerateGuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feature extends Model
{
    use GenerateGuid, SoftDeletes;
    protected $guarded = [];

    public function detail()
    {
        $language = Language::find(session('language_id'));
        return $this->hasOne(FeatureDetail::class)->where('language_id', $language->id);
    }
    public function category()
    {
        return $this->belongsTo(Category::class)->with('detail');
    }
}
