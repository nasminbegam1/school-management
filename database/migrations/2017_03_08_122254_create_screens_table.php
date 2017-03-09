<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScreensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('screens', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('modules_id')->unsigned();
            $table->foreign('modules_id')->references('id')->on('modules')->onDelete('no action')->onUpdate('no action');
            $table->string('screen_name',255);
            $table->integer('updated_by')->nullable();
            $table->integer('is_deleted')->nullable();
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
        Schema::table('screens', function(Blueprint $table){
            $table->dropForeign(['modules_id']);
            $table->dropColumn('modules_id');
        });
        Schema::drop('screens');
    }
}
