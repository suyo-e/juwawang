<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIconsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('icons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('pic_url');
            $table->integer('type');
            $table->string('category_ids')->nullable();
            $table->integer('rank');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('icons');
    }
}
