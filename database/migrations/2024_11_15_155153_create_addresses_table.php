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
    Schema::create('provinces', function (Blueprint $table) {
        $table->id();
        $table->string('province_name');
        $table->timestamps();
    });

    Schema::create('cities', function (Blueprint $table) {
        $table->id();
        $table->string('city_name');
        $table->foreignId('province_id')->constrained('provinces')->onDelete('cascade');
        $table->enum('type', ['Kabupaten', 'Kota']);
        $table->timestamps();
    });

    Schema::create('districts', function (Blueprint $table) {
        $table->id();
        $table->string('district_name');
        $table->foreignId('city_id')->constrained('cities')->onDelete('cascade');
        $table->timestamps();
    });

    Schema::create('villages', function (Blueprint $table) {
        $table->id();
        $table->string('village_name');
        $table->foreignId('district_id')->constrained('districts')->onDelete('cascade');
        $table->timestamps();
    });

    Schema::create('addresses', function (Blueprint $table) {
        $table->id();
        $table->uuid('user_id');
        $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        $table->foreignId('province_id')->constrained('provinces');
        $table->foreignId('city_id')->constrained('cities');
        $table->foreignId('district_id')->constrained('districts');
        $table->foreignId('village_id')->constrained('villages');
        $table->string('street_address');
        $table->string('additional_info')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
