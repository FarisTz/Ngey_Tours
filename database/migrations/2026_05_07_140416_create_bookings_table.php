<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            // What type of booking
            $table->enum('booking_type', ['tour', 'package', 'car']);

            $table->string('Full_name')->nullable();
            $table->string('Email')->nullable();
            // Links to specific items (only one will be filled per booking)
            $table->foreignId('tour_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('package_id')->nullable()->constrained()->onDelete('set null');

            // Booking details
            $table->date('start_date');
            $table->date('end_date')->nullable(); // not needed for single-day tours
            $table->integer('num_children')->default(1);
            $table->integer('num_adults')->default(1);
            $table->text('special_requests')->nullable();

            // Pickup (mainly for car bookings)
            $table->string('pickup_location')->nullable();
            $table->string('destination')->nullable();

            // Pricing
            $table->decimal('subtotal', 10, 2);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('total_price', 10, 2);

            // Status
            $table->enum('status', [
                'pending',
                'confirmed',
                'ongoing',
                'completed',
                'cancelled'
            ])->default('pending');

            // Reference number for the customer
            $table->string('booking_reference')->unique();

            // Admin notes
            $table->text('admin_notes')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
