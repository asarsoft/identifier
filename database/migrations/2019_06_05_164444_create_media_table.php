<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('guid');

            $table->string('source')->comment('name for the given media source');
            $table->string('display_name')->nullable()->comment('name for the given media source');
            $table->string('type')->default('image')->comment('Determines what type of media this is: Video, Image, Audio etc');

            $table->string('credits_name')->nullable()->comment('name for the given media source');
            $table->string('credits_url')->nullable()->comment('name for the given media source');

	        $table->string('media_type')->comment('Name of the related object');
	        $table->bigInteger('media_id')->comment('Name of the related object');

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
        Schema::dropIfExists('media');
    }
}
