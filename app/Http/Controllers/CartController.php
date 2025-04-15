<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;



class CartController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:menu_items,id',
            'quantity' => 'required|integer|min:1',
        ]);
    
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
    
        // Get the menu item details
        $menuItem = MenuItem::findOrFail($productId);
    
        // Check if the item already exists in the cart
        $existingCartItem = Cart::where('item_id', $productId)->first();
    
        if ($existingCartItem) {
            // Update the quantity of the existing item
            $existingCartItem->increment('quantity', $quantity);
        } else {
            // Create a new cart item with the name and image from the MenuItem model
            Cart::create([
                'item_id' => $productId,
                'name' => $menuItem->name,
                'quantity' => $quantity,
                'price' => $menuItem->price,
                'image' => $menuItem->image,
            ]);
        }
    
        return redirect()->route('menu.category', ['category' => 'Deals'])->with('success', 'Item added to cart!');
    }

    public function index()
    {
        // Get cart items with their associated MenuItem details
        $cartItems = Cart::with('item')->get();
        $serviceType = Cookie::get('order_type');
    
        // Calculate the total price
        $total = $cartItems->sum(function ($cartItem) {
            return $cartItem->item->price * $cartItem->quantity;
        });
    
        return view('cart.index', compact('cartItems', 'total','serviceType'));
    }

    public function create(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'total_amount' => 'required|numeric',
            'service_type' => 'required|string',
        ]);
    
        DB::beginTransaction();
    
        try {
            // Create a new order
            $order = Order::create([
                'total_amount' => $request->total_amount,
                'status' => 'Pending',
                'payment_status' => 'Pending',
                'service_type' => $request->service_type,
            ]);
    
            // Retrieve the cart items from the database
            $cartItems = Cart::with('item')->get();
    
            // Check if cart items are available
            if ($cartItems->isEmpty()) {
                return redirect()->back()->with('error', 'No items in the cart to place an order.');
            }
    
            // Insert order items
            foreach ($cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'item_id' => $cartItem->item_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->item->price,
                ]);
            }
    
            DB::commit();
    
            // Clear the cart table after order is placed
            Cart::truncate();
    
            return redirect()->route('service')->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to place order. Please try again.');
        }
    }

public function service()
{
    return view('service'); 
}

public function update(Request $request, $productId)
{
    // Validate that the quantity is a positive integer
    $request->validate([
        'quantity' => 'required|integer|min:1',
    ]);

    // Find the cart item by item_id
    $cartItem = Cart::where('item_id', $productId)->first();

    if ($cartItem) {
        // Update the quantity of the cart item
        $cartItem->quantity = $request->quantity;
        $cartItem->save();  // Save the updated cart item

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
    }

    return redirect()->route('cart.index')->with('error', 'Item not found in cart.');
}

public function remove($productId){

    $cartItem = Cart::where('item_id',$productId)->first();

    if($cartItem){
        $cartItem->delete();
    
        return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
    }

    return redirect()->route('cart.index')->with('error', 'Item not found in cart.');
}

public function selectProduct($cartItemId)
{
    $cartItem = Cart::findOrFail($cartItemId);  // Retrieve the cart item to update
    $menuItems = MenuItem::all();  // Get all menu items for selection
    
    // Pass both the cart item and menu items to the view
    return view('cart.index', compact('cartItem', 'menuItems'));
}

public function updateProduct(Request $request, $cartItemId, $newProductId)
{
    $cartItem = Cart::findOrFail($cartItemId);
    $newProduct = MenuItem::findOrFail($newProductId);

    // Update the cart with the new product details
    $cartItem->item_id = $newProduct->id;
    $cartItem->name = $newProduct->name;
    $cartItem->price = $newProduct->price;
    $cartItem->image = $newProduct->image;
    $cartItem->save();

    return redirect()->route('cart.index')->with('success', 'Product updated successfully!');
}

   
}