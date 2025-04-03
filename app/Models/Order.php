<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Specify the table if it's not the plural form of the model name
    protected $table = 'orders';

    // Specify the fillable attributes
    protected $fillable = [
        'user_id', // Assuming you have a user associated with the order
        'total_price',
        'status', // e.g., pending, completed, canceled
        'created_at',
        'updated_at',
    ];

    // Define relationships
    public function user()
    {
        return $this->belongsTo(User::class); // Assuming you have a User model
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class); // Assuming you have an OrderItem model
    }

    public function modifiers()
    {
        return $this->hasManyThrough(Modifier::class, OrderModifier::class);
    }
}