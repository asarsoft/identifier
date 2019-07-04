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
				'user_id' => Auth::check() ? Auth::id() : null,
				'ip' => request()->ip(),
				'loggable_guid' => $model->guid,
				'loggable_type' => $model->getTable(),
				'type' => 'creating',
				'record' => serialize($model->attributes),
				'created_at' => Carbon::now()
			]);
		});
		static::updating(function ($model) {
			DB::table('logs')->insert([
				'user_id' => Auth::check() ? Auth::id() : null,
				'ip' => request()->ip(),
				'loggable_guid' => $model->guid,
				'loggable_type' => $model->getTable(),
				'type' => 'updating',
				'record' => serialize($model->attributes),
				'created_at' => Carbon::now()
			]);
		});
		static::deleted(function ($model) {
			DB::table('logs')->insert([
				'user_id' => Auth::check() ? Auth::id() : null,
				'ip' => request()->ip(),
				'loggable_guid' => $model->guid,
				'loggable_type' => $model->getTable(),
				'type' => 'deleted',
				'record' => 'not defined',
				'created_at' => Carbon::now()
			]);
		});
		static::restored(function ($model) {
			DB::table('logs')->insert([
				'user_id' => Auth::check() ? Auth::id() : null,
				'ip' => request()->ip(),
				'loggable_guid' => $model->guid,
				'loggable_type' => $model->getTable(),
				'type' => 'restored',
				'record' => 'not defined',
				'created_at' => Carbon::now()
			]);
		});
	}
}