<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('guid');

            $table->string('name')->comment('Full name for the given language');
            $table->string('language_code')->comment('Short name that is returned from the browser');
            $table->string('icon')->default('no_image.jpg')->nullable();

            $table->boolean('is_featured')->default(false)->comment('If the language is not active, it does not appear in any list');

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
        Schema::dropIfExists('languages');
    }
}
