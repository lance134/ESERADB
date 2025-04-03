<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    // Specify the table if it's not the plural form of the model name
    protected $table = 'menu_items';

    // Specify the fillable attributes
    protected $fillable = [
        'name',
        'details',
        'price',
        'category',
        'is_available',
        'image',
    ];

    // Optionally, define relationships if needed
    // For example, if you have an OrderItem model that relates to MenuItem
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}