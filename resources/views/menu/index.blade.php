<x-layout>
<body class="bg-gray-100 text-black">
<p>Service type in session: {{$serviceType}}

</p>

        {{-- Sidebar & Menu --}}
        <div class="flex">
        {{-- Sidebar Navigation --}}
        <div class="w-1/4">
    <ul class="space-y-2">
        @foreach (['Deals', 'Rice Meals', 'Burgers', 'Fries', 'Drinks', 'Sides & More'] as $category)
            <li>
                <a href="{{ route('menu.category', ['category' => $category]) }}" class="block text-center px-4 py-2 border border-black rounded-lg font-semibold hover:bg-black hover:text-white transition 
                   @if (isset($selectedCategory) && $selectedCategory == $category) bg-black text-white @endif">
                    {{ $category }}
                </a>
            </li>
        @endforeach
    </ul>
</div>

            {{-- Menu Items --}}
            <div class="w-3/4 grid grid-cols-4 gap-4 mx-4 px-4">
    @foreach ($menuItems as $item)
        <div class="border border-black rounded-lg p-3 shadow-lg">
            @if ($item['badge'])
                <span class="bg-red-500 text-white px-2 py-1 text-xs rounded-full">{{ $item['badge'] }}</span>
            @endif
            <a href="{{ route('menu.item', ['id' => $item['id']]) }}">
                <img src="{{ asset('images/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-32 object-cover rounded">
                <h3 class="font-semibold mt-2">{{ $item['name'] }}</h3>
                <p class="text-sm text-gray-600">{{ $item['price'] }}</p>
            </a>
        </div>
    @endforeach
</div>
        </div>
    </div>

</body>
</x-layout>
