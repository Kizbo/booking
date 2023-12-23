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
                    <main class="flex flex-col w-full">
                        <div class="px-4 grow max-w-full">

                            <!-- session message -->
                            @if(session("message"))
                                @php
                                    $colors = match (session("message")['type']) {
                                        "success" => "bg-green-100 border-l-green-500",
                                        default => ''
                                    }
                                @endphp

                                <div class="w-full max-w-4xl mt-8 sm:px-6 lg:px-8">
                                    <div class="flex items-center gap-x-6 px-8 py-7 border-l border-l-4 {{ $colors }}">

                                        @switch(session("message")['type'])
                                            @case("success")
                                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                                                    <rect width="32" height="32" rx="6" fill="#34D399"/>
                                                    <path d="M23.2984 10.8268L23.2868 10.8118L23.2741 10.7978C22.9173 10.4019 22.3238 10.4008 21.9657 10.7944L13.9189 19.4538L10.0567 15.2868C9.69856 14.8929 9.10487 14.8939 8.748 15.2899C8.41733 15.6568 8.41733 16.2234 8.748 16.5903L8.74796 16.5903L8.7527 16.5954L12.8674 21.0348C13.1444 21.3405 13.5286 21.5 13.8958 21.5C14.2924 21.5 14.6518 21.3355 14.924 21.035L23.2162 12.1116C23.5833 11.7445 23.576 11.1861 23.2984 10.8268Z" fill="white" stroke="white"/>
                                                </svg>
                                                @break
                                        @endswitch

                                        <p class="text-neutral-800">{{ session("message")['text'] }}</p>
                                    </div>
                                </div>
                            @endif

                            <!-- heading -->
                            @if(!empty($header))
                                <h1 class="w-full text-3xl mx-auto sm:px-6 lg:px-8 mt-8">{{ $header }}</h1>
                            @endif

                            {{ $slot }}
                        </div>
                    </main>
                </div>
            </div>

            @stack("body-scripts")
    </body>
</html>
