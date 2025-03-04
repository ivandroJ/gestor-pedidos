@extends('layouts.app')
@section('content')
    <div class="bg-white p-8 rounded-lg shadow-lg w-96">
        <h2 class="text-2xl font-bold mb-6 text-center">Iniciar Sessão</h2>
        <form method="POST" action="/auth">
            @csrf
            <div class="mb-4">
                <x-input-text id='email' name="email" title="E-mail" type="email" placeholder="Insira o seu e-mail"
                    value="{{ old('email') }}" />
            </div>
            <div class="mb-6">
                <x-input-text id='password' name="password" title="Senha" type="password" placeholder="Insira a sua senha"
                    value='' />

            </div>
            <div class="flex items-center justify-between mb-5">

                <a href="/usuario/recuperar_senha" class="text-sm text-indigo-600 hover:text-indigo-500">Esqueceu sua
                    senha?</a>
            </div>
            @error('usuario')
                <div class="mb-1 text-center">
                    <span class="text-xs text-red-500">{{ $message }}</span>
                </div>
            @enderror
            <x-button type="submit" color="blue" color_tone='600' px="4" py="2"
                class="w-full">Entrar</x-button>
        </form>

    </div>
@endsection
