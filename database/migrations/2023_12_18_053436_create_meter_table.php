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
        Schema::create('meter', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('MID')->unique();
            $table->enum('type',['residential','industrial'])->default('residential');
            $table->decimal('rate', 8, 4)->default(9.6758);
            $table->float('present_reading')->default(0.00);
            $table->float('previous_reading')->default(0.00);
            $table->string('PIN')->unique();
            $table->string('Owner');
            $table->string('Address');
            $table->timestamps();
            $table->index('MID');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meter');
    }
};
