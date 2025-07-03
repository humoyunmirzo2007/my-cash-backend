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
        Schema::create('cash_box_conversions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('from_cash_box_id')
                ->constrained('cash_boxes')
                ->restrictOnDelete();
            $table->foreignId('to_cash_box_id')
                ->constrained('cash_boxes')
                ->restrictOnDelete();
            $table->decimal('from_amount', 10, 2);
            $table->decimal('to_amount', 10, 2);
            $table->decimal('exchange_rate', 12, 2);
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_box_conversions');
    }
};
