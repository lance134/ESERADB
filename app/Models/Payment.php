<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    // Specify the table if it's not the plural form of the model name
    protected $table = 'payments';

    // Specify the fillable attributes
    protected $fillable = [
        'order_id', // Foreign key referencing the orders table
        'amount', // Amount paid
        'payment_method', // e.g., credit card, cash, etc.
        'status', // e.g., completed, pending, failed
        'transaction_id', // Unique transaction identifier
    ];

    // Define relationships
    public function order()
    {
        return $this->belongsTo(Order::class); // Each payment belongs to an order
    }
}