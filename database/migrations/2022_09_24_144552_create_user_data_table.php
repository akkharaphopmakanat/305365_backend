<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_data', function (Blueprint $table) {
            $table->increments('userid');
            $table->string('username');
            $table->string('email');
            $table->string('password');
            $table->string('fullname');
            $table->date('birthdate');
        });
        Schema::create('user_extra', function (Blueprint $table) {
            $table->string('username');
            $table->string('address');
            $table->string('telno');
            $table->string('profession');
        });
        Schema::create('course', function (Blueprint $table) {
            $table->increments('cource_id');
            $table->string('c_name');
            $table->integer('cat_id');
            $table->string('c_description');
            $table->string('c_teacher');
            $table->json('c_requirement');
            $table->json('c_video');
        });
        Schema::create('teacher', function (Blueprint $table) {
            $table->increments('id');
            $table->string('c_teacher');
            $table->string('username');
        });
        Schema::create('user_complete', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('c_name');
        });
        Schema::create('user_course_active', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->integer('c_id');
            $table->string('status');
            $table->date('regdate');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_data');
        Schema::dropIfExists('user_extra');
        Schema::dropIfExists('course');
        Schema::dropIfExists('teacher');
        Schema::dropIfExists('user_complete');
        Schema::dropIfExists('user_course_active');
    }
}
