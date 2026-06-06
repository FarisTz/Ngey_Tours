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
        Schema::create('taxi_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('pickup_location');
            $table->string('destination');
            $table->date('travel_date');
            $table->string('travel_time');
            $table->unsignedInteger('passengers');
            $table->string('vehicle_type');
            $table->string('whatsapp_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taxi_bookings');
    }
};
