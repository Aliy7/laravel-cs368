<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Venty</title>
    <!-- Scripts -->
    @vite(['resources/js/app.js'])
</head>

<body class="antialiased">
    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        @if (Route::has('login'))
            <livewire:welcome.navigation />
        @endif

        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <div class="flex justify-center">
                <a href="{{ route('dashboard') }}" class="flex items-center">
                    <img src="{{ asset('storage/logo/venty.png') }}" alt="Logo" class="h-10 w-auto">
                </a>
            </div>
            <h1 class="font-bold font-sans "> Welcome to venty..to use venty please create account and login</h1>
            <div class="flex justify-center mt-16 px-0 sm:items-center sm:justify-between">
                <div class="text-center text-sm text-gray-500 dark:text-gray-400 sm:text-start">
                    <div class="flex items-center gap-4">       
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
