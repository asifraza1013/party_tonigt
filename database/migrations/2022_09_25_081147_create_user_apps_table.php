<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_apps', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('user_name')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('country')->nullable();
            $table->string('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('phone')->nullable();
            $table->string('image')->nullable();
            $table->string('otp')->nullable();
            $table->boolean('admin_approved')->default(true);
            $table->boolean('enable_notifications')->default(true);
            $table->string('status');
            $table->rememberToken();
            $table->integer('type')->default(1)->comment('1: User, 2: Event Manager');
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
        Schema::dropIfExists('user_apps');
    }
}
