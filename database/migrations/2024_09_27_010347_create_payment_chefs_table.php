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
        Schema::create('payment_chefs', function (Blueprint $table) {
            $table->id();
            $table->string('currency');          
            $table->string('bank_name');         
            $table->string('account_type');      
            $table->string('account_number');    
            $table->string('swift_number')->nullable();   
            $table->string('account_branch')->nullable();    
            $table->string('iban')->nullable();
            $table->foreignId('chef_id')->references('id')->on('chefs')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_chefs');
    }
};
