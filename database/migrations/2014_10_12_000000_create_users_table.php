<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    //users
    Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    //customers
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title');
            $table->text('lname');
            $table->text('fname');
            $table->text('addressline');
            $table->text('town');
            $table->text('zipcode');
            $table->text('phone');
            $table->text('img_path')->default('images/customers.jpg');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('user_id')->unsigned();
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

        });
    //employee
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title');
            $table->text('lname');
            $table->text('fname');
            $table->text('addressline');
            $table->text('town');
            $table->text('zipcode');
            $table->text('phone');
            $table->text('role');
            $table->text('img_path')->default('images/employees.jpg');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('user_id')->unsigned();
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

        });
    //pets
    Schema::create('pets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade')->onUpdate('cascade');
            $table->text('name');
            $table->text('type');
            $table->text('breed');
            $table->text('img_path')->default('images/pets.jpg');
            $table->timestamps();
            $table->softDeletes();
        });
    //services
    Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->text('description');
            $table->integer('price');
            $table->text('img_path');
            $table->timestamps();
            $table->softDeletes();
        });
    
    //transaction orderinfo
    Schema::create('orderinfo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->text('status');
            $table->timestamps();
            $table->softDeletes();
        });

    //transaction orderline
    Schema::create('orderline', function (Blueprint $table) {
            $table->integer('orderinfo_id')->unsigned();
            $table->foreign('orderinfo_id')->references('id')->on('orderinfo')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('service_id')->unsigned();
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade')->onUpdate('cascade');
        });

    //comments
    Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('services_id');
            $table->foreign('services_id')->references('id')->on('services');
            $table->string('guests')->default('Unknown');;
            $table->string('comments', 255);
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
        Schema::dropIfExists('customers');
        Schema::dropIfExists('pets');
        Schema::dropIfExists('services');
        Schema::dropIfExists('users');
        Schema::dropIfExists('consultations');
        Schema::dropIfExists('injuries');
        Schema::dropIfExists('consultinfo');
        Schema::dropIfExists('orderinfo');
        Schema::dropIfExists('orderline');
        Schema::dropIfExists('comments');
    }
};
