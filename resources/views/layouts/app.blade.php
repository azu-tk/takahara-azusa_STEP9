<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
            <footer class="bg-white border-t border-gray-200 mt-auto py-8">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col items-center">
                    
                    <div class="mb-4">
                        <a href="{{ route('contacts.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded shadow transition">
                            お問い合わせ
                        </a>
                    </div>
                    
                    <div class="flex space-x-6 mb-4">
                        <a href="{{ route('products.index') }}" class="text-blue-600 hover:text-blue-800 font-bold transition">Home</a>
                        <a href="{{ route('dashboard') }}" class="text-blue-600 hover:text-blue-800 font-bold transition">マイページ</a>
                    </div>
                    
                    <div class="text-sm text-gray-500">
                        &copy; {{ date('Y') }} Company,Inc
                    </div>
                    
                </div>
            </footer>

            </div>
    </body>
        </div>
    </body>
</html>
