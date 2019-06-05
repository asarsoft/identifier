<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectSocialmediaTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('project_socialmedia', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('guid');

			$table->bigInteger('project_id');

			$table->string('icon')->nullable();
			$table->string('name')->comment('Display name of the given Social-media');
			$table->text('url');
			$table->string('type')->nullable()->comment('Instagram, Facebook, Twitter, etc.');

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
		Schema::dropIfExists('project_socialmedia');
	}
}
