<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIndustriesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('industries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('display_name');
            $table->integer('user_id:unsigned:foreign,users,id');
            $table->string('avatar', 255);
            $table->string('pic_urls');
            $table->string('indetity_urls');
            $table->integer('prov_id');
            $table->integer('city_id');
            $table->string('address', 255);
            $table->string('service');
            $table->string('description');
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
        Schema::drop('industries');
    }
}
