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
        Schema::create('deposit_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('deposit_transaction_id')->constrained('deposit_transactions')->cascadeOnDelete();
            $table->foreignId('waste_category_id')->constrained('waste_categories')->cascadeOnDelete();
            $table->decimal('weight', 12, 3)->default(0);
            $table->decimal('price', 12, 2)->default(0);
            $table->decimal('subtotal', 14, 2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deposit_items');
    }
};
