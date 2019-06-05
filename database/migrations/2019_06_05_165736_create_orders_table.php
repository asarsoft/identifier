<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('guid');

            $table->string('name')->comment('This is the name for the order');
            $table->text('description')->nullable()->comment('This is the description for the order');

            $table->string('customer_name')->nullable()->comment('Customer Name');
            $table->string('email')->comment('Email for contact');
            $table->string('mobile')->nullable()->comment('Mobile for contact');

            $table->timestamp('desired_date')->nullable()->comment('When the user wants this project to be finished');
            $table->time('contact_date')->nullable()->comment('When can you contact to the Customer');

            $table->integer('category_id');
            $table->integer('max_scale')->comment('Maximum number of users can use this application at the same time');

            $table->string('domain');

            $table->boolean('has_server');
            $table->boolean('has_asarsoft');

            $table->string('status')->default('new')->comment('new, accepted, in_progress, rejected');

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
        Schema::dropIfExists('orders');
    }
}
