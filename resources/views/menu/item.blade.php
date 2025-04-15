<x-layout>
<body class="bg-gray-100 text-black flex flex-col items-center min-h-screen">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden max-w-4xl flex flex-col md:flex-row mt-4">
        <div class="md:w-1/2">
            <img src="{{ asset('images/' . $item->image) }}" alt="{{ $item->name }}" class="w-full h-full object-cover">
        </div>
        <div class="p-6 md:w-1/2 flex flex-col justify-between">
            <div>
                <h2 class="text-gray-500 text-sm font-bold uppercase mb-6">{{ $item->category }}</h2>
                <h1 class="text-3xl font-bold text-black mb-6">{{ $item->name }}</h1>
                <p class="text-gray-700 mt-4">{{ $item->details }}</p>
            </div>
            <div class="mt-2 flex flex-col items-start">
                <div class="flex items-center justify-between w-full mb-2">
                    <p class="text-xl font-semibold">₱ {{ number_format($item->price, 2) }}</p>
                    <div class="flex flex-col items-center">
                        <form action="{{ route('cart.add') }}" method="POST" class="mt-1 flex flex-col items-center w-full">
                            @csrf
                        <p class="text-sm text-gray-600">Quantity</p>
                        <input type="number" name="quantity" value="1" min="1" class="border border-gray-300 rounded px-2 py-1 w-16 text-center">
                    </div>
                </div>
                    <input type="hidden" name="product_id" value="{{ $item->id }}">
                    <button type="submit" class="bg-yellow-500 text-black font-bold px-6 py-2 rounded-lg hover:bg-yellow-600 w-full">ADD TO CART</button>
                </form>
            </div>
        </div>
    </div>
</body>
</x-layout>