<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name') }} - @yield('title', 'Home')</title>
        <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"></script>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="font-sans antialiased dark:bg-gray-900 dark:text-gray-300">

        <div class="min-h-screen bg-gray-100 dark:bg-gray-900 flex flex-col justify-between">
            <header class="bg-white dark:bg-gray-800 shadow py-4">
                <div class="container mx-auto px-4">
                    <div class="flex justify-between items-center">
                        <div class="text-2xl font-bold">
                            <a href="{{ route('users.home') }}" class="text-gray-800 dark:text-gray-200">
                                {{ config('app.name', 'Laravel') }}
                            </a>
                        </div>
                        <nav class="space-x-4">
                            <a href="{{ route('users.home') }}" class="text-gray-600 dark:text-gray-300">Home</a>
                        </nav>
                    </div>
                </div>
            </header>

            <main class="flex-grow container mx-auto px-4 py-8">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                    @yield('content')
                </div>
            </main>

            <footer class="bg-white dark:bg-gray-800 shadow py-4">
                <div class="container mx-auto px-4 text-center">
                    <p class="text-gray-600 dark:text-gray-300">&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
                </div>
            </footer>
        </div>
        @stack('custom_scripts')
    </body>
</html>
