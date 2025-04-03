<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    @vite('resources/css/app.css') {{-- Load Tailwind CSS --}}
</head>
<body class="bg-white text-black">

    <div class="max-w-6xl mx-auto py-6 px-4">
        <h1 class="text-3xl font-bold">Your Cart</h1>

        @if(session('success'))
            <div class="bg-green-500 text-white p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="space-y-4">
            @foreach ($orders as $productId => $order)
                <div class="border border-black rounded-lg p-4 shadow-md">
                    <div class="flex justify-between items-center">
                        <span class="font-bold">{{ $order['quantity'] }}X</span>
                        <h3 class="font-semibold text-lg">{{ $order['name'] }}</h3>
                        <span class="font-bold">₱ {{ number_format($order['price'], 2) }}</span>
                    </div>
                </div>
            @endforeach
        </div>

        <h2 class="text-xl font-bold mt-4">Total: ₱ {{ number_format($ total, 2) }}</h2>
    </div>
</body>
</html>