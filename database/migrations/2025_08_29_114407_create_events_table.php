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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->text('description')->nullable();
            $table->dateTime('date_time');
            $table->string('location', 255);
            $table->integer('capacity');
            $table->unsignedBigInteger('organiser_id'); // FK to users
            $table->string('image_path')->nullable();   // optional event image
            $table->timestamps();
            $table->foreign('organiser_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
