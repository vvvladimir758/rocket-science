<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rs_products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->decimal('price', 9, 3);
            $table->string('quantity');
            $table->timestamps();
        });

        Schema::create('rs_properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
        });

        Schema::create('rs_properties_options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->string('text_val');
            $table->integer('int_val');

            $table->foreign('property_id')->references('id')->on('rs_properties');
        });

        Schema::create('rs_products_properties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('property_option_id');

            $table->foreign('product_id')->references('id')->on('rs_products');
            $table->foreign('property_option_id')->references('id')->on('rs_properties_options');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rs_products');
        Schema::dropIfExists('rs_products_properties');
        Schema::dropIfExists('rs_properties');
        Schema::dropIfExists('rs_properties_options');
    }
};
