<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar');
            $table->string('title_en');
            $table->string('phone1');
            $table->string('phone2');
            $table->string('email1');
            $table->string('email2');
            $table->string('address1_ar');
            $table->string('address1_en');
            $table->string('address2_ar');
            $table->string('address2_en');
            $table->string('logo_white');
            $table->string('logo_black');
            $table->string('fav_ico');
            $table->string('breadcrumb');
            $table->string('facebook');
            $table->string('twitter');
            $table->string('youtube');
            $table->string('instagram');
            $table->string('snapchat');
            $table->string('linkedin');
            $table->string('system_time_zone')->default("Africa/Cairo");

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
        Schema::dropIfExists('settings');
    }
}
