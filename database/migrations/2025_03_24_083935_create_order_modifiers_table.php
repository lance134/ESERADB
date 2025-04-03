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
        Schema::create('order_modifiers', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->foreignId('order_item_id')->constrained('order_items')->onDelete('cascade'); // Foreign key referencing order_items table
            $table->foreignId('modifier_id')->constrained('modifiers')->onDelete('cascade'); // Foreign key referencing modifiers table
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_modifiers');
    }
};
