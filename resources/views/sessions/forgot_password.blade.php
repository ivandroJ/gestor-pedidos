@extends('layouts.app')
@section('content')
    <div class="bg-white p-8 rounded-lg shadow-lg w-96">
        <h2 class="text-2xl font-bold mb-6 text-center">Recuperar Senha</h2>
        <form method="POST" action="/usuario/reset_password" onsubmit="return confirm('Tem certeza?')">
            @csrf
            <div class="mb-4">
                <x-input-text id='email' name="email" title="E-mail" type="email" placeholder="Insira o seu e-mail"
                    value="{{ old('email') }}" />
            </div>

            <x-button type="submit" color="blue" color_tone='600' px="4" py="2"
                class="w-full">Recuperar</x-button>
        </form>

    </div>
@endsection
