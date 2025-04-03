<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modifier extends Model
{
    use HasFactory;

    // Specify the table if it's not the plural form of the model name
    protected $table = 'modifiers';

    // Specify the fillable attributes
    protected $fillable = [
        'name',
        'price',
        'is_available',
    ];

    // Optionally, define relationships if needed
    // For example, if you have an OrderModifier model that relates to Modifier
    public function orderModifiers()
    {
        return $this->hasMany(OrderModifier::class);
    }
}