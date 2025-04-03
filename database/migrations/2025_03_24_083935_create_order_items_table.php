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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->foreignId('order_id')->constrained()->onDelete('cascade'); // Foreign key referencing orders table
            $table->foreignId('item_id')->constrained('menu_items')->onDelete('cascade'); // Foreign key referencing menu_items table
            $table->integer('quantity'); // Quantity of the item ordered
            $table->decimal('price', 10, 2); // Price of the item at the time of order
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
