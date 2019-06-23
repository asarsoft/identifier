<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categories', function (Blueprint $table) {
			$table->increments('id');
			$table->string('guid');

			$table->integer('parent_id')->nullable();
			$table->string('title')->nullable();

			$table->string('icon')->nullable();

			$table->softDeletes();
			$table->timestamps();
		});

		Schema::create('category_detail', function (Blueprint $table) {
			$table->increments('id');
			$table->string('guid');

			$table->string('name');
			$table->text('description');

			$table->integer('language_id');
			$table->integer('category_id');

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
		Schema::dropIfExists('categories');
	}
}
