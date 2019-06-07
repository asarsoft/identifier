<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('guid');

            $table->bigInteger('user_id')->nullable();
            $table->string('email')->nullable();
            $table->string('ip')->nullable();

            $table->string('loggable_guid');
            $table->string('loggable_type')->comment('User, Project, Order, Feature');
            $table->string('type')->comment('create, update, forceDelete, softDelete');

            $table->text('before');
            $table->text('after');

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
        Schema::dropIfExists('logs');
    }
}