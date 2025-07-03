<?php

use App\Enums\CashboxCurrencyTypes;
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
        Schema::create('cash_box_operations', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained()->cascadeOnDelete();
            $table->foreignId("input_type_id")->nullable()->constrained()->restrictOnDelete();
            $table->foreignId("output_type_id")->nullable()->constrained()->restrictOnDelete();
            $table->enum("currency", array_column(CashboxCurrencyTypes::cases(), "value"));
            $table->decimal("amount", 10, 2);
            $table->text("comment")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_box_operations');
    }
};
