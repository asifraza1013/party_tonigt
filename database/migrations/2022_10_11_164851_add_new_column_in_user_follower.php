<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnInUserFollower extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_follower', function (Blueprint $table) {
            $table->boolean('is_blocked')->default(false)->after('accepted_at');
            $table->boolean('only_block')->default(false)->after('is_blocked');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_follower', function (Blueprint $table) {
            //
        });
    }
}
