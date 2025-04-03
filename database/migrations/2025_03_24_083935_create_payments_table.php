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
        Schema::create('payments', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->foreignId('order_id')->constrained()->onDelete('cascade'); // Foreign key referencing orders table
            $table->decimal('amount', 10, 2); // Amount paid
            $table->enum('payment_method', ['Credit Card', 'Cash', 'Mobile Payment']); // Payment method
            $table->enum('status', ['Pending', 'Completed', 'Failed'])->default('Pending'); // Payment status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
