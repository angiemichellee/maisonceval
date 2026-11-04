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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->integer('catalog_id');                     // id catalogs 
            $table->integer('category_id');                    // id categories
            $table->string('name');
            $table->string('slug')->unique();                  // /menu/lemon-pie-tart
            $table->integer('price');
            $table->text('description');
            $table->string('image')->nullable();               // images/products/lemon-pie-tart.jpg
            $table->text('variants')->nullable();              // flavours, saved as JSON text
            $table->string('includes')->nullable();            // kyk Merry Christmas topper, card & ribbon
            $table->boolean('is_available')->default(true);    // false = hidden dari website
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
