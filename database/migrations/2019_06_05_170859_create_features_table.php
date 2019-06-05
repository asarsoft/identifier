<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeaturesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('features', function (Blueprint $table) {
			$table->increments('id');
			$table->string('guid');

			$table->integer('category_id');

			$table->string('icon')->nullable();

			$table->bigInteger('min_price')->nullable()->comment('Price should always be defined in USD');
			$table->bigInteger('max_price')->nullable()->comment('Price should always be defined in USD');

			$table->integer('approximate_time')->comment('Required time to implement this feature by hour');
			$table->integer('difficulty')->comment('Difficulty Rate over 100');

			$table->integer('priority');

			$table->softDeletes();
			$table->timestamps();
		});

		Schema::create('feature_detail', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('guid');

			$table->integer('feature_id')->unsigned();
			$table->integer('language_id')->unsigned();

			$table->string('name')->comment('Name for the given feature');
			$table->text('description')->nullable()->comment('Description for the given Feature');
			$table->string('feature_type')->comment('Ex: Advanced, Extra, Primary, Core, Premium');

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
		Schema::dropIfExists('features');
	}
}
