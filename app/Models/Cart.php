<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'item_id',
        'name',
        'quantity',
        'price',
        'image'
    ];

    public function item()
    {
        return $this->belongsTo(MenuItem::class, 'item_id');
    }
}
