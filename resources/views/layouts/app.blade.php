<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} {{ Route::currentRouteName() ? ' - ' . Route::currentRouteName() : '' }}
    </title>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @livewireStyles()
</head>

<body class="bg-gray-100 {{ Auth::check() ? '' : 'flex items-center justify-center h-screen' }}">
    <div id="app">

        @auth
            <x-nav-bar-component />
        @endauth

        @if (Auth::check())
            <div class="container mx-auto px-4 pt-20">
                @include('inc.msg')

                @if (isset($page_title))
                    <div class="flex justify-between items-center mb-2">
                        <h2 class="text-2xl text-gray-600 font-bold">{{ $page_title }}</h2>
                    </div>
                @endif
                @yield('content')

                @if (url()->current() != url('/inicio') && !isset($hide_btn_back))
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
            @include('inc.msg')
            @yield('content')
        @endif

    </div>
    @livewireScripts()

    <script>
        function formatarMontante(input) {
            // Remove todos os caracteres que não são dígitos
            let valor = input.value.replace(/\D/g, '');

            valor = (valor / 100).toLocaleString('{{ app()->getLocale() }}', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
            input.value = valor;


        }

        function hide_element(id) {
            document.getElementById(id).classList.add('hidden')
        }
    </script>
</body>

</html>
