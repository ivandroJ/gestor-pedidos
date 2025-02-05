@extends('layouts.app')
@section('content')
    <h3 class="text-5xl text-green-500 mb-2">
        👋 Olá, {{ Auth::user()->primeiroNome() }} ...
    </h3>
    <p class="text-sm text-muted text-gray-500">Bem-vindo(a) ao Gestor de Pedidos de Materiais!</p>
    <div class="flex flex-wrap -mx-4 mt-10">
        @foreach ($opcoes_menu as $opcao)
            <div class="md:w-full px-2 py-1">
                <a href="{{ $opcao['url'] }}" class="w-full">
                    <div
                        class="mb-3 text-center w-full bg-{{ $opcao['color'] }}-600
                         text-white py-10  px-3 rounded-md
                         hover:bg-{{ $opcao['color'] }}-700 focus:outline-none
                         focus:ring-2 focus:ring-{{ $opcao['color'] }}-500 focus:ring-offset-2">

                        <span class="text-3xl">
                            <i class="{{ $opcao['icon'] }}"></i>
                            {{ $opcao['label'] }}
                        </span>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection
