<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\Order;
use App\Models\MenuItem; 
use App\Models\Cart;

class MenuItemController extends Controller
{
    public function index()
    {
        $menuItems = MenuItem::all()->map(function ($item) {
            return [
                'name' => $item->name,
                'details' => $item->details,
                'price' => '₱' . number_format($item->price, 2),
                'badge' => $item->is_available ? null : 'Unavailable',
                'category' => $item->category,
                'image' => $item->image
            ];
        });
    
        $selectedCategory = null;
        $cartItems = Cart::with('item')->get();
        $serviceType = Cookie::get('order_type');
    
        return view('menu.index', compact('menuItems', 'selectedCategory', 'serviceType'));
    }
    
    
    public function showByCategory($category)
    {
        // Fetch menu items by category
        $menuItems = MenuItem::where('category', $category)->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'details' => $item->details,
                'price' => '₱' . number_format($item->price, 2),
                'badge' => $item->is_available ? null : 'Unavailable',
                'category' => $item->category,
                'image' => $item->image // Include the image attribute
            ];
        });
    
        // Pass the selected category to the view
        return view('menu.index', compact('menuItems', 'category'));
    }

    public function show($id)
{
    $item = MenuItem::findOrFail($id);
    $cartCount = Cart::count();
    $serviceType = Cookie::get('order_type');

    return view('menu.item', compact('item', 'cartCount','serviceType'));
}

public function setServiceType($type)
{
    // Set the cookie for the service type
    Cookie::queue('order_type', $type, 60); // 60 minutes expiration

    return redirect()->route('menu.index'); // Redirect to menu or another page
}

}
