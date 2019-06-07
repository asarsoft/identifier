<?php

namespace App\Models;

use App\Models\Concerns\GenerateGuid;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use GenerateGuid;
    protected $table = 'categories';
    protected $guarded = [];

    public function detail(){
        $language = Language::find(session('language_id'));
        return $this->hasOne(CategoryDetail::class)->where('language_id', $language->id);
    }
}
