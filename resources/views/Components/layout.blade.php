
<!DOCTYPE html>
    <html>
      <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>McDonald's Menu</title>
        @vite('resources/css/app.css') {{-- Load Tailwind CSS --}}
      </head>

        <title>Laravel</title>


        
        
            <body>
            <div class="max-w-6xl mx-auto py-6 px-4">
        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <div class="flex items-center space-x-3">
                <img src="{{ asset('images/logo.png') }}" alt="McDonald's" class="h-12">
                <h1 class="text-2xl font-bold">Hey, <span class="font-extrabold text-gray-800">What will <span class="text-yellow-500">YOU</span> have?</span></h1>
            </div>
            <div class="relative">
                <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs px-2 py-1 rounded-full">0</span>
                <img src="{{ asset('images/cart.png') }}" alt="Cart" class="h-8">
            </div>
        </div>
              {{$slot}}
            </body>


    </html>


    