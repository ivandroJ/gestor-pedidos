<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - {{ Route::currentRouteName() }}</title>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @livewireStyles()
</head>

<body class="bg-gray-100 {{ Auth::check() ? '' : 'flex items-center justify-center h-screen' }}">
    <div id="app">
        @include('inc.msg')
        @auth
            <x-nav-bar-component />
        @endauth

        @if (Auth::check())
            <div class="container mx-auto px-4 pt-20">
                @yield('content')

                @if(url()->current() != url('/inicio') && !isset($hide_btn_back))
                <div class="mt-6">
                    <a href="{{ $back_url ?? url()->previous() }}"
                        class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
                        <i class="fas fa-arrow-left"></i>
                        Voltar
                    </a>
                </div>
                @endif
            </div>
        @else
            @yield('content')
        @endif

    </div>
    @livewireScripts()
</body>

</html>
