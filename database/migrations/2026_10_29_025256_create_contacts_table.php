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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('instagram')->nullable();
            $table->string('email')->nullable();
            $table->string('phoneNumber')->nullable();   // text, because numbers start with 0 / +62
            $table->string('whatsapp')->nullable();
            $table->string('address')->nullable();
            $table->string('opening_hours')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
