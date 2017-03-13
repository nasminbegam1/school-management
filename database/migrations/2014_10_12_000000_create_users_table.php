<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            
            //            $table->increments('id');
            //$table->string('name');
            //$table->string('email')->unique();
            //$table->string('password');
            // $table->string('mob1');
            //$table->string('mob2');
            //$table->integer('is_active');
            //$table->integer('school_user_type_id')->unsigned();
            //$table->rememberToken();
            //$table->timestamps();
            
            $table->increments('id');
            $table->string('name');
            $table->string('user_id');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('mob1');
            $table->string('mob2');
            $table->integer('is_active');
            $table->integer('school_user_type_id')->unsigned();
            $table->string('school_id');
            $table->integer('updated_by');
            $table->integer('is_deleted');
            $table->rememberToken();
            $table->timestamps();
            
            $table->foreign('school_user_type_id')->references('id')->on('usertypes')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
