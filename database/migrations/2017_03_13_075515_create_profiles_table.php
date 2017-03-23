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
            $table->string('avatar')->nullable()->default('');
            $table->integer('type');
            $table->integer('user_id');
            $table->integer('prov_id');
            $table->integer('city_id');
            $table->integer('area_id')->nullable()->default(0);
            $table->integer('category_id');
            $table->string('category_ids');
            $table->integer('sex')->nullable()->default(0);
            $table->string('service')->nullable()->default('');

            // 邀请机制
            $table->string('invite_code')->nullable()->default('');
            $table->integer('invite_count')->nullable()->default(0);
            $table->integer('recommand_count')->nullable()->default(0);

            $table->integer('industry_id')->nullable()->default(0);
            $table->string('industry_name', 255)->nullable()->default('');

            $table->integer('is_identity')->nullable()->default(0);
            $table->integer('is_recommand')->nullable()->default(0);
            // verify
            $table->string('realname')->nullable()->default('');
            $table->string('identity_str')->nullable()->default('');
            $table->text('identity_urls')->nullable();

            $table->text('remark')->nullable();

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
