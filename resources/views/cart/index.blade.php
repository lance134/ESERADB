<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    @vite('resources/css/app.css') {{-- Load Tailwind CSS --}}
</head>
<body class="bg-gray-100 text-black flex flex-col items-center min-h-screen">
    <div class="max-w-6xl mx-auto py-6 px-4 w-full">
        <a href="{{ url('/menu-items/category/Deals') }}">
            <img src="" alt="McDonald's Logo" class="h-24">
        </a>
       
        <h1 class="text-2xl font-bold mb-6">Your Cart</h1>
        @if (count($cartItems) > 0)
            <ul>
                @foreach ($cartItems as $productId => $item)
                    <li class="flex justify-between border-b py-2">
                        <div class="flex items-center">
                            <img src="{{ asset('images/' . $item['image']) }}" alt="{{ $item['name'] }}" class="h-16 w-16 object-cover mr-4">
                            <div>
                                <span>{{ $item['name'] }}</span><br>
                                <span>Quantity: 
                                <form action="{{ route('cart.update', $item->item_id) }}" method="POST" class="inline">
                                    @csrf
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="w-16 text-center" onchange="this.form.submit()">
                                </form>
                                </span><br>
                                <span>₱ {{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                            </div>
                        </div>
                        <form action="{{ route('cart.remove', $item->item_id) }}" method="POST">
                             @csrf
                             @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">Remove</button>
                        </form>
                    </li>
                @endforeach
            </ul>
            <div class="mt-4 font-bold">
                Total: ₱ {{ number_format($total, 2) }}
            </div>
            <form action="{{ route('order.create') }}" method="POST" class="mt-4">
                @csrf
                <input type="hidden" name="total_amount" value="{{ $total }}">
                <input type="hidden" name="service_type" value="{{ session('service_type', 'Dine In') }}">
                <button type="submit" class="bg-yellow-500 text-black font-bold px-6 py-2 rounded-lg hover:bg-yellow-600">Place Order</button>
            </form>
        @else
            <p>Your cart is empty.</p>
        @endif
    </div>
</body>
</html>