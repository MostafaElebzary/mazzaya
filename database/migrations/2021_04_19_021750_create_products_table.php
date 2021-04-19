<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('title_ar');
            $table->string('title_en');
            $table->string('model_ar');
            $table->string('model_en');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('brand_id')->constrained('brands')->onDelete('cascade');
            $table->string('unit_ar');
            $table->string('unit_en');
            $table->string('main_image');
            $table->longText('description_ar');
            $table->longText('description_en');
            $table->double('price');
            $table->enum('discount_type', ['ratio', 'amount'])->default('amount');
            $table->integer('discount')->nullable();
            $table->integer('quantity');
            $table->integer('min_quantity');
            $table->string('meta_title')->nullable();
            $table->longText('meta_description')->nullable();


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
        Schema::dropIfExists('products');
    }
}
