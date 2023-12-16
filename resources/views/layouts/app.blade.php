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
        <div class="flex w-full">
            <livewire:layout.drawer />
            <div class="min-h-screen bg-slate-200 grow">
                <livewire:layout.navigation />

                <!-- Page Content -->
                <main class="flex w-full">
                    <div class="px-4 grow">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>
