<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolmodulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schoolmodules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('school_id');
            $table->integer('module_id')->index()->unsigned();
            $table->integer('is_active')->default(0);
            $table->integer('is_deleted')->default(0);
            $table->timestamps();
            $table->foreign('module_id')->references('id')->on('modules')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('schoolmodules');
    }
}
