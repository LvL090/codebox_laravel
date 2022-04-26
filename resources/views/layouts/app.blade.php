<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
</head>
<body class="z">
    <div class="h-screen flex flex-col justify-between" id="app">
        <div>
            @guest
                @component('component.navbar')
                @endcomponent
            @endguest

            @auth
                @component('component.navbarauth')
                @endcomponent
            @endauth
            <main class="mb-auto h-auto">
                @yield('content')
            </main>
        </div>

        <footer class="h-auto inset-x-0 bottom-0">
            @component('component.footer')
            @endcomponent
        </footer>
    </div>
</body>
</html>
