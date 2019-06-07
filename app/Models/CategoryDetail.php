<?php

namespace App\Models;

use App\Models\Concerns\GenerateGuid;
use Illuminate\Database\Eloquent\Model;

class CategoryDetail extends Model
{
    use GenerateGuid;
    protected $table = 'category_detail';
    protected $guarded = [];
}
