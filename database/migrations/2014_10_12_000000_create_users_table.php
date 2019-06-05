<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('guid');

			$table->string('email')->unique();
			$table->string('slug')->unique();
			$table->string('mobile')->nullable();

			$table->string('name');
			$table->string('avatar')->default('avatar.jpg');
			$table->string('role_id')->nullable();

			$table->timestamp('email_verified_at')->nullable();
			$table->timestamp('mobile_verified_at')->nullable();

			$table->timestamp('banned_at')->nullable();
			$table->timestamp('confirmed_at')->nullable();

			$table->string('password');

			$table->rememberToken();

			$table->softDeletes();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('users');
	}
}
