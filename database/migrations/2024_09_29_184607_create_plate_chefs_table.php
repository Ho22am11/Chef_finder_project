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
        Schema::create('plate_chefs', function (Blueprint $table) {
            $table->id();
            $table->string('name_plate');
            $table->string('customization');
            $table->json('Appetizer')->nullable();
            $table->foreignId('menus_id')->references('id')->on('menus_chefs')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plate_chefs');
    }
};
