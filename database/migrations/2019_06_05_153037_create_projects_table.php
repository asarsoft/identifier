<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('projects', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('guid');

			$table->integer('category_id');
			$table->bigInteger('user_id');
			$table->bigInteger('customer_id')->nullable();
			$table->bigInteger('project_type_id')->comment('Project Type can be: Confounding, Open Source, Official');
			$table->bigInteger('order_id')->nullable()->comment('Which order does this project belongs to');

			$table->integer('progress_status')->default(0)->comment('Progress status indicates the development status');
			$table->string('slug');

			$table->bigInteger('like_count')->default('0');
			$table->bigInteger('view_count')->default('0')->comment('Indicates how many times the project was viewed by public');

			$table->timestamp('finished_at')->nullable();
			$table->timestamp('started_at')->nullable();
			$table->timestamp('accepted_at')->nullable();
			$table->timestamp('requested_at')->nullable();

			$table->softDeletes();
			$table->timestamps();
		});

		Schema::create('project_detail', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('guid');

			$table->bigInteger('project_id');
			$table->bigInteger('language_id');

			$table->string('title');
			$table->string('description')->nullable();
			$table->text('body');
			$table->string('cover')->nullable();
			$table->string('url')->nullable();

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
		Schema::dropIfExists('projects');
	}
}
