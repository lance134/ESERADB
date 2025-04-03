<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderModifier extends Model
{
    use HasFactory;

    // Specify the table if it's not the plural form of the model name
    protected $table = 'order_item_modifier'; // Assuming this is the name of your pivot table

    // Specify the fillable attributes
    protected $fillable = [
        'order_item_id', // Foreign key referencing the order_items table
        'modifier_id', // Foreign key referencing the modifiers table
    ];

    // Define relationships
    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class); // Each order modifier belongs to an order item
    }

    public function modifier()
    {
        return $this->belongsTo(Modifier::class); // Each order modifier belongs to a modifier
    }
}   