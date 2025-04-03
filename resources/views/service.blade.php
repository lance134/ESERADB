<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>McDonald's Order</title>
    @vite('resources/css/app.css') {{-- Ensure Tailwind CSS is loaded --}}
</head>
<body class="flex flex-col items-center justify-center min-h-screen bg-red-600 text-white">

    {{-- McDonald's Logo --}}
    <div class="mb-6">
        <img src="{{ asset('images/logo.png') }}" alt="McDonald's Logo" class="h-24">
    </div>

    {{-- Question --}}
    <h2 class="text-xl font-semibold mb-6">Where would you be eating today?</h2>

    {{-- Options --}}
    <div class="flex space-x-6">
        {{-- Dine-In --}}
        <a href="{{ route('dinein') }}" class="flex flex-col items-center bg-white text-black p-6 rounded-lg shadow-lg hover:scale-105 transition">
            <img src="{{ asset('images/dinein.png') }}" alt="Dine-In" class="h-20 mb-2">
            <span class="font-bold">Dine-In</span>
        </a>

        {{-- Take-Out --}}
        <a href="{{ route('takeout') }}" class="flex flex-col items-center bg-white text-black p-6 rounded-lg shadow-lg hover:scale-105 transition">
            <img src="{{ asset('images/takeout.png') }}" alt="Take-Out" class="h-20 mb-2">
            <span class="font-bold">Take-Out</span>
        </a>
    </div>

</body>
</html>
