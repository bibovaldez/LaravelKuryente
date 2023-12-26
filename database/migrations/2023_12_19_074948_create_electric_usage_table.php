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
        Schema::create('electric_usage', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('meter_id');
            $table->float('usage')->default(0.00);
            $table->timestamp('recorded_at');
            $table->timestamps();
            $table->foreign('meter_id')->references('id')->on('meter')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('electric_usage');
    }
};
