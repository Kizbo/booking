<html>

<head>
    @livewireStyles
    @stack('page-styles')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <header>

    </header>
    <main>
        {{ $slot }}
    </main>
    <footer>

    </footer>
    @livewire('wire-elements-modal')
    @stack('body-scripts')
    @livewireScripts
</body>

</html>
