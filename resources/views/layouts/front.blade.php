<html>

<head>
    @livewireStyles
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
