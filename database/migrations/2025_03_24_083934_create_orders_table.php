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
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->decimal('total_amount', 10, 2); // Total amount for the order
            $table->enum('status', ['Pending', 'Completed', 'Cancelled'])->default('Pending'); // Order status
            $table->enum('payment_status', ['Pending', 'Paid', 'Refunded'])->default('Pending'); // Payment status
            $table->enum('service_type', ['Dine In', 'Takeout']); // Service type
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
