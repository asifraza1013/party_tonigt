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
            $table->timestamp("last_seen")->nullable();
            $table->tinyInteger("is_online")->default(0)->nullable();
            $table->tinyInteger("is_active")->default(1)->nullable();
            $table->text("about")->nullable();
            $table->string("photo_url")->nullable();
            $table->string("activation_code")->nullable();
            $table->tinyInteger("is_system")->default(0)->nullable();
            $table->integer('type')->default(1)->comment('1: User, 2: Event Manager');
            $table->rememberToken();
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
