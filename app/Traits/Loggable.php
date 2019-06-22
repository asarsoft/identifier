<?php

namespace App\Traits;

use App\Models\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait Loggable
{
	public static function bootLoggable()
	{
		static::creating(function ($model) {
			DB::table('logs')->insert([
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
			DB::table('logs')->insert([
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
			DB::table('logs')->insert([
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
			DB::table('logs')->insert([
				'user_id' => Auth::id(),
				'email' => Auth::user()->email,
				'ip' => request()->ip(),
				'loggable_guid' => $model->guid,
				'loggable_type' => $model->getTable(),
				'type' => 'restored',
				'before' => 'not defined',
				'after' => 'not defined',
				'created_at' => Carbon::now()
			]);
		});
	}
}