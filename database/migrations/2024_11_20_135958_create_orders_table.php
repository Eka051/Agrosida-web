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
            $table->id('order_id');
            $table->uuid('user_id');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->enum('status', ['pending', 'completed', 'cancelled'])->default('pending');
            $table->foreignId('payment_id')->constrained('payments', 'payment_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
