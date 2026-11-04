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
        Schema::create('catalogs', function (Blueprint $table) {
            $table->id();
            $table->string('name');                          // Everyday Menu, Christmas Collection
            $table->string('slug')->unique();                // used in the URL: /catalog/christmas
            $table->string('tagline')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();             // cover photo, e.g. images/products/x.jpg
            $table->string('color')->default('#64501B');     // banner colour
            $table->boolean('is_seasonal')->default(false);  // true = Christmas, Halloween...
            $table->boolean('is_active')->default(true);     // false = hidden from the website
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalogs');
    }
};
