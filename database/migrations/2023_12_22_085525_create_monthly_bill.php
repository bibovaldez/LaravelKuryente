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
        Schema::create('monthly_bill', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('meter_id');
            $table->char('year_month', 7);
            $table->float('bill_amount', 10, 2);
            $table->foreign('meter_id')->references('id')->on('meter')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthly_bill');
    }
};
