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
}
