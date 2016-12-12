<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->string('voice')->nullable();
            $table->string('title');
            $table->text('description');
            $table->timestamp('published_at');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')->onDelete('set null');

//            $table->foreign('img_id')
//                ->references('id')
//                ->on('images')
//                ->onUpdate('cascade')->onDelete('set null');
//
//            $table->foreign('video_id')
//                ->references('id')
//                ->on('videos')
//                ->onUpdate('cascade')->onDelete('set null');
//
//            $table->foreign('voice_id')
//                ->references('id')
//                ->on('voices')
//                ->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function($table) {
            $table->dropForeign(['user_id']);
        });
//        Schema::table('posts', function($table) {
//            $table->dropForeign(['img_id']);
//        });
//        Schema::table('posts', function($table) {
//            $table->dropForeign(['video_id']);
//        });
//        Schema::table('posts', function($table) {
//            $table->dropForeign(['voice_id']);
//        });

        Schema::dropIfExists('posts');
    }
}
