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
        Schema::create('calendar_chefs', function (Blueprint $table) {
            $table->id();
            $table->date('day');
            $table->boolean('available')->nullable()->default(true);
            $table->boolean('breakfast')->default(true);  
            $table->boolean('lunch')->default(true);      
            $table->boolean('dinner')->default(true); 
            $table->foreignId('chef_id')->references('id')->on('chefs')->cascadeOnDelete();
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendar_chefs');
    }
};
