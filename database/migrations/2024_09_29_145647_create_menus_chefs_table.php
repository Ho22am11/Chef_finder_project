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
        Schema::create('menus_chefs', function (Blueprint $table) {
            $table->id();
            $table->string('name_menu');
            $table->string('type_food');
            $table->integer('min');
            $table->integer('max');
            $table->integer('price_2');
            $table->integer('price_6');
            $table->integer('price_20');
            $table->foreignId('chef_id')->references('id')->on('chefs')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus_chefs');
    }
};
