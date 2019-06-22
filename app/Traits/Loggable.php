<?php

namespace App\Traits;

use App\Models\Log;
use Illuminate\Support\Facades\Auth;

trait Loggable
{
	public static function bootLoggable()
	{
		static::creating(function ($model) {
			Log::create([
				'user_id' => Auth::id(),
				'email' => Auth::user()->email,
				'ip' => request()->ip(),
				'loggable_guid' => $model->guid,
				'loggable_type' => $model->getTable(),
				'type' => 'creating',
				'before' => 'not defined',
				'after' => 'not defined',
			]);
		});
		static::updating(function ($model) {
			Log::create([
				'user_id' => Auth::id(),
				'email' => Auth::user()->email,
				'ip' => request()->ip(),
				'loggable_guid' => $model->guid,
				'loggable_type' => $model->getTable(),
				'type' => 'updating',
				'before' => serialize($model->getOriginal()),
				'after' => serialize($model->attributes),
			]);
		});
		static::deleted(function ($model) {
			Log::create([
				'user_id' => Auth::id(),
				'email' => Auth::user()->email,
				'ip' => request()->ip(),
				'loggable_guid' => $model->guid,
				'loggable_type' => $model->getTable(),
				'type' => 'deleted',
				'before' => 'not defined',
				'after' => 'not defined',
			]);
		});
		static::restored(function ($model) {
			Log::create([
				'user_id' => Auth::id(),
				'email' => Auth::user()->email,
				'ip' => request()->ip(),
				'loggable_guid' => $model->guid,
				'loggable_type' => $model->getTable(),
				'type' => 'restored',
				'before' => 'not defined',
				'after' => 'not defined',
			]);
		});
	}
}