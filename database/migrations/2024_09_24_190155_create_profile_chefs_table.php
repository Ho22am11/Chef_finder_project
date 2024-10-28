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
        Schema::create('profile_chefs', function (Blueprint $table) {
            $table->id();
            $table->string('f_name');
            $table->string('l_name');
            $table->string('img');
            $table->text('BIO')->nullable();
            $table->json('language')->nullable();
            $table->text('about')->nullable();
            $table->text('experience')->nullable();
            $table->text('learned_at')->nullable();
            $table->text('tips')->nullable();
            $table->string('web')->nullable();
            $table->string('facebook')->nullable();
            $table->text('instagram')->nullable();
            $table->text('Twitter')->nullable();
            $table->text('youtube')->nullable();
            $table->text('linkedin')->nullable();
            $table->foreignId('chef_id')->references('id')->on('chefs')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_chefs');
    }
};
