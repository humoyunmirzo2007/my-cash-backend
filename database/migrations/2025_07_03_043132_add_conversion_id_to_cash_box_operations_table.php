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
        Schema::table('cash_box_operations', function (Blueprint $table) {
            $table->foreignId('conversion_id')
                ->nullable()
                ->constrained('cash_box_conversions')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cash_box_operations', function (Blueprint $table) {
            //
        });
    }
};
