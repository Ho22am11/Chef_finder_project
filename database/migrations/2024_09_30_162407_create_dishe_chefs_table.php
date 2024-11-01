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
        Schema::create('dishe_chefs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category');
            $table->string('Cuisine');
            $table->foreignId('chef_id')->references('id')->on('chefs')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dishe_chefs');
    }
};
