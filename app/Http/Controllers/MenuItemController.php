<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\MenuItem; 

class MenuItemController extends Controller
{
    public function index()
    {
        // Fetch all menu items for the initial load
        $menuItems = MenuItem::all()->map(function ($item) {
            return [
                'name' => $item->name,
                'details' => $item->details,
                'price' => '₱' . number_format($item->price, 2),
                'badge' => $item->is_available ? null : 'Unavailable',
                'category' => $item->category,
                'image' => $item->image // Include the image attribute
            ];
        });
    
        // Pass null for selected category on initial load
        return view('menu.index', compact('menuItems', 'selectedCategory'));
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
    $item = MenuItem::findOrFail($id); // Assuming you have a MenuItem model
    return view('menu.item', compact('item'));
}
}
