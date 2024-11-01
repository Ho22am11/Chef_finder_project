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
            $table->string('f_name')->nullable();
            $table->string('l_name')->nullable();
            $table->text('BIO')->nullable();
            $table->json('lang')->nullable();
            $table->text('about')->nullable();
            $table->text('experience')->nullable();
            $table->text('learned_at')->nullable();
            $table->text('guides')->nullable();
            $table->text('web')->nullable();
            $table->text('face')->nullable();
            $table->text('insta')->nullable();
            $table->text('Twitter')->nullable();
            $table->text('youtube')->nullable();
            $table->text('linkedin')->nullable();
            $table->foreignId('chef_id')->references('id')->on('chefs')->cascadeOnDelete();;
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
