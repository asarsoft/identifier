<?php

namespace App\Models\Concerns;

use Illuminate\Support\Str;

trait GenerateGuid
{
    protected static function bootGenerateGuid()
    {
        static::creating(function ($model) {
            if (!$model->getKey())
            {
                $model->guid = (string)Str::uuid();
            }
        });
    }
}
