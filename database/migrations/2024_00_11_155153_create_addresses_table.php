<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // public function up(): void
    // {
    //     Schema::create('provinces', function (Blueprint $table) {
    //         $table->id('province_id');
    //         $table->string('province_name');
    //         $table->timestamps();
    //     });

    //     Schema::create('cities', function (Blueprint $table) {
    //         $table->id('city_id');
    //         $table->string('city_name');
    //         $table->foreignId('province_id')->constrained('provinces', 'province_id')->onDelete('cascade');
    //         $table->enum('type', ['Kabupaten', 'Kota']);
    //         $table->timestamps();
    //     });

    //     Schema::create('districts', function (Blueprint $table) {
    //         $table->id('district_id');
    //         $table->string('district_name');
    //         $table->foreignId('city_id')->constrained('cities', 'city_id')->onDelete('cascade');
    //         $table->timestamps();
    //     });

    //     Schema::create('villages', function (Blueprint $table) {
    //         $table->id('village_id');
    //         $table->string('village_name');
    //         $table->foreignId('district_id')->constrained('districts', 'district_id')->onDelete('cascade');
    //         $table->timestamps();
    //     });

    //     Schema::create('addresses', function (Blueprint $table) {
    //         $table->id('address_id');
    //         $table->foreignId('province_id')->constrained('provinces', 'province_id');
    //         $table->foreignId('city_id')->constrained('cities'. 'city_id');
    //         $table->foreignId('district_id')->constrained('districts', 'district_id');
    //         $table->foreignId('village_id')->constrained('villages', 'district_id');
    //         $table->string('street_address');
    //         $table->string('additional_info')->nullable();
    //         $table->timestamps();
    //     });
    // }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
