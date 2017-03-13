<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterFieldsOnuserandscreen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('users', function($table) {
            $table->enum('is_email_verified',['1','0'])->default(0);
        });

        Schema::table('screens', function($table) {
            $table->enum('is_left_view',['1','0'])->default(0);
            $table->integer('parent_id')->nullable()->index();
            $table->string('url_string');
            $table->string('url_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
