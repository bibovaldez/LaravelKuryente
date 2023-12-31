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
        Schema::create('1day_usage', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('meter_id');
            $table->decimal('usage', 18, 10);
            $table->timestamp('recorded_at');
            $table->decimal('usagemark', 18, 10);
            $table->foreign('meter_id')->references('id')->on('meter')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('1day_usage');
    }
};
