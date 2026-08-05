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
        Schema::create('withdrawal_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_number')->unique()->nullable();
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();
            $table->date('transaction_date');
            $table->unsignedBigInteger('amount')->default(0);
            $table->text('notes')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdrawal_transactions');
    }
};
