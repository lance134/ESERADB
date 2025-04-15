<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\support\Facades\Cookie;


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
        $serviceType = Cookie::get('order_type'); // ✅ Get the cookie correctly
        $view->with('serviceType', $serviceType);
    }
}
