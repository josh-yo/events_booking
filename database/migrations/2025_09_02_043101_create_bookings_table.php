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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            // Foreign key: references the events table
            $table->foreignId('event_id')->constrained()->onDelete('cascade');

            // Foreign key: references the users table (attendee)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->timestamps();

            // Prevent duplicate bookings
            $table->unique(['event_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
