<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('guid');

            $table->string('comment')->comment('A feedback about the given progress status');

            $table->bigInteger('project_id');
            $table->bigInteger('parent_id')->nullable();
            $table->bigInteger('user_id');

            $table->integer('progress_level')->nullable()->comment('At which progress level this comment was made');

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
        Schema::dropIfExists('status_comments');
    }
}
