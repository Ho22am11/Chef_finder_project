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
        Schema::create('location_chefs', function (Blueprint $table) {
            $table->id();
            $table->decimal('latitude' , 10 , 8);
            $table->decimal('longitude' , 11 , 8);
            $table->foreignId('chef_id')->references('id')->on('chefs')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('location_chefs');
    }
};
