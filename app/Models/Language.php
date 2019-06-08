<?php

namespace App\Models;
use App\Models\Concerns\GenerateGuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Language extends Model
{
    use GenerateGuid, SoftDeletes;

    protected $guarded = [];
}
