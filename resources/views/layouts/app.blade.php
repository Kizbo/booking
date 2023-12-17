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

        @stack("head-scripts")
    </head>
    <body class="font-sans antialiased">
            <div class="flex max-w-full">
                <livewire:layout.drawer />
                <div class="bg-slate-200 grow max-w-full">
                    <livewire:layout.navigation />

                    <!-- Page Content -->
                    <main class="flex w-full">
                        <div class="px-4 grow max-w-full">
                            @if(!empty($header))
                                <h1 class="w-full text-3xl mx-auto sm:px-6 lg:px-8 mt-8">{{ $header }}</h1>
                            @endif

                            {{ $slot }}
                        </div>
                    </main>
                </div>
            </div>
    </body>
</html>
