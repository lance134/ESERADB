<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Cart;

class CartComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        // Calculate or retrieve your cart count
        $cartCount = Cart::count();

        // Share the data with the view
        $view->with('cartCount', $cartCount);
    }

    
}
