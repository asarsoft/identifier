<?php

namespace App\Models;

use App\Models\Concerns\GenerateGuid;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use GenerateGuid;

    protected $guarded = [];
}
