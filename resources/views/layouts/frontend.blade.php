<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center">
                        <span class="text-xl font-bold">{{ config('app.name') }}</span>
                    </a>
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="{{ route('home') }}" class="text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 border-transparent hover:border-indigo-500">
                            Home
                        </a>
                        <a href="{{ route('products') }}" class="text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 border-transparent hover:border-indigo-500">
                            Products
                        </a>
                        <a href="{{ route('contact') }}" class="text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 border-transparent hover:border-indigo-500">
                            Contact
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <main class="py-12">
        @yield('content')
    </main>
    <footer class="bg-white">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 md:flex md:items-center md:justify-between lg:px-8">
            <div class="mt-8 md:mt-0 md:order-1">
                <p class="text-center text-base text-gray-400">
                    &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                </p>
            </div>
        </div>
    </footer>
</body>
</html>
