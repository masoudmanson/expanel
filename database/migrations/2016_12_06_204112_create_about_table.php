<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAboutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('image')->nullable();
            $table->text('description');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')->onDelete('set null');

//            $table->foreign('img_id')
//                ->references('id')
//                ->on('images')
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
        Schema::table('about', function($table) {
            $table->dropForeign(['user_id']);
        });
//        Schema::table('about', function($table) {
//            $table->dropForeign(['img_id']);
//        });
        Schema::dropIfExists('about');
    }
}
