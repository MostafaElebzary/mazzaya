<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGlobalSeosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('global_seos', function (Blueprint $table) {
            $table->id();
            $table->string('keywords');
            $table->longText('description');
            $table->string('author');
            $table->bigInteger('visits')->default(0);
            $table->string('site_map_link');
            $table->tinyInteger('is_google')->default(0);
            $table->string('google_analytics');
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
        Schema::dropIfExists('global_seos');
    }
}
