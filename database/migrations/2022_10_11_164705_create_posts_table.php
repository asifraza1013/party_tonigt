<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_apps_id');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->enum('type', config('constants.enums.post_type'))->default('Image');
            $table->integer('category')->nullable();
            $table->integer('share_count')->default(0);
            $table->string('video_thumbnail_url')->nullable();
            $table->string('text_location_on_video')->nullable();
            $table->string('status')->default(config('constants.post_status.Active'));
            $table->text('youtube_link')->nullable();

            $table->json('media_url')->nullable();
            $table->json('tags')->nullable();
            $table->json('friends')->nullable();

            $table->string('price')->nullable(0);
            $table->string('total_tickets')->nullable(0);

            $table->boolean('is_event')->default(false);
            $table->boolean('is_story')->default(false);

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_apps_id')->references('id')->on('user_apps')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
