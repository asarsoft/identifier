<?php

namespace App\Models;
use App\Models\Concerns\GenerateGuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectSocialmedia extends Model
{
    use GenerateGuid, SoftDeletes;
    protected $guarded = [];

    //
}
