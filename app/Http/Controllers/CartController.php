<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;

class CartController extends Controller
{
    public function add(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
        ]);

        // Logic to add the product to the cart
        $cart = session()->get('cart', []);
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        // Fetch product details from the database
        $product = MenuItem::findOrFail($productId);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity; // Update quantity if already in cart
        } else {
            $cart[$productId] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'details' => [$product->description], // Add more details if needed
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function index()
{
    $orders = session()->get('cart', []);
    $total = 0;

    foreach ($orders as $order) {
        $total += $order['price'] * $order['quantity'];
    }

    return view('cart.index', compact('orders', 'total'));
}
}
