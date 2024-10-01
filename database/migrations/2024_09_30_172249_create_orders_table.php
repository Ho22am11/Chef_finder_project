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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('service');
            $table->string('state');
            $table->integer('Adults');
            $table->integer('Teens');
            $table->integer('Children');
            $table->string('Cuisines');
            $table->string('meal');
            $table->date('day');
            $table->string('Packages');
            $table->string('Additional_service');
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('chef_id')->nullable()->references('id')->on('chefs')->nullOnDelete();
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
