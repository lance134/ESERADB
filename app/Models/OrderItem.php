<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    // Specify the table if it's not the plural form of the model name
    protected $table = 'order_items';

    // Specify the fillable attributes
    protected $fillable = [
        'order_id', // Foreign key referencing the orders table
        'menu_item_id', // Foreign key referencing the menu_items table
        'quantity',
        'price', // Price at the time of order
    ];

    // Define relationships
    public function order()
    {
        return $this->belongsTo(Order::class); // Each order item belongs to an order
    }

    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class); // Each order item belongs to a menu item
    }

    public function modifiers()
    {
        return $this->belongsToMany(Modifier::class, 'order_item_modifier'); // Assuming a pivot table for modifiers
    }
}