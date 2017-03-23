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
            $table->integer('user_id');
            $table->string('avatar', 255);
            $table->string('pic_urls')->nullable()->default('');
            $table->string('identity_urls')->nullable()->default('');
            $table->integer('prov_id');
            $table->integer('city_id');
            $table->integer('area_id')->nullable()->default(0);
            $table->string('address', 255)->nullable()->default('');
            $table->string('service')->nullable()->default('');
            $table->text('description')->nullable();
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
