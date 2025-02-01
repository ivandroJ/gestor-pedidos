@extends('layouts.app')
@section('content')
    <h3 class="text-5xl mb-10 text-green-500">
       👋 Olá, {{ request()->user()->primeiroNome() }} ...
    </h3>
    <div class=" md:flex space-x-4">
        @foreach (Config::get('constants.OPCOES_MENU_' . request()->user()->perfil, []) as $opcao)
            <a href="{{ $opcao['url'] }}" class="w-full">
                <div
                    class="mb-3 text-center w-full bg-{{ $opcao['color'] }}-600 text-white py-10  px-3 rounded-md hover:bg-{{ $opcao['color'] }}-700 focus:outline-none focus:ring-2 focus:ring-{{ $opcao['color'] }}-500 focus:ring-offset-2">

                    <span class="text-xl">
                        <i class="{{ $opcao['icon'] }}"></i>
                        {{ $opcao['label'] }}
                    </span>
                </div>
            </a>
        @endforeach
    </div>
@endsection
