<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('description');
            $table->integer('user_id');
            $table->string('type_name');
            $table->integer('category_id');
            $table->integer('industry_id');
            $table->integer('prov_id');
            $table->integer('city_id');
            $table->string('brand_name');
            $table->string('pic_url');
            $table->string('price');
            $table->string('address');
            $table->string('contact_name');
            $table->string('wechat');
            $table->string('qq');
            $table->string('phone');
            $table->integer('view_count');
            $table->integer('collect_count');
            $table->string('banner_urls');
            $table->integer('status');
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
        Schema::drop('products');
    }
}
