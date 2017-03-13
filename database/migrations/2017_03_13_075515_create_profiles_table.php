<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProfilesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type');
            $table->integer('user_id');
            $table->integer('prov_id');
            $table->integer('city_id');
            $table->integer('industry_id');
            $table->string('industry_name', 255);
            $table->integer('category_id');
            $table->string('service');
            $table->string('identity_urls');
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
        Schema::drop('profiles');
    }
}
