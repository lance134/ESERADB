<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\MenuItem; 

class OrderController extends Controller
{
    public function showOrder()
    {
        // Fetch orders from the database
        $orders = Order::with('menuItem')->get(); // Assuming you have a relationship set up
        $total = $orders->sum(function ($order) {
            return $order->quantity * $order->menuItem->price; // Calculate total
        });

        return view('your_order', compact('orders', 'total'));
    }

    public function dineIn()
{
    // Redirect to the Deals category using the showByCategory method
    return redirect()->route('menu.category', ['category' => 'Deals']);
}

public function takeOut()
{
    // Redirect to the Deals category using the showByCategory method
    return redirect()->route('menu.category', ['category' => 'Deals']);
}
}
