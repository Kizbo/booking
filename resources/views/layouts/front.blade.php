<html>

<head>
    @livewireStyles
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
    @stack('body-scripts')
    @livewireScripts
</body>

</html>
