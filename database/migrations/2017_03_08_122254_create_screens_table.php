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
        Schema::create('Screen_Master', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('modules_id')->unsigned();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->string('screen_name',255);
            $table->string('screen_alise',255);
            $table->integer('updated_by')->nullable();
            $table->integer('is_active')->default(0);
            $table->integer('is_left_visible')->default(0);
            $table->integer('is_deleted')->nullable();
            $table->timestamps();
        });
        Schema::table('Screen_Master', function($table) {

            $table->foreign('modules_id')->references('id')->on('Modules')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('parent_id')->references('id')->on('Screen_Master')->onDelete('cascade')->onUpdate('cascade');
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
