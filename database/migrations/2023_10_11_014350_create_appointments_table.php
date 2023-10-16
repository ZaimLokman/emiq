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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id(); // Primary key, auto-incrementing
            $table->string('code')->unique(); // Unique code field
            $table->datetime('appt_datetime'); // Datetime field
            $table->unsignedBigInteger('patient_id'); // Foreign key reference to the patients table
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->timestamp('created_at')->useCurrent(); // Automatically set the creation timestamp
            $table->timestamp('arrived_at')->nullable(); // Nullable timestamp
            $table->enum('status', ['pending', 'arrived', 'rescheduled']); // Status field with specific values
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
