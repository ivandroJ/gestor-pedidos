@extends('layouts.app')
@section('content')
    <div class="bg-white p-8 rounded-lg shadow-lg w-96">
        <h2 class="text-2xl font-bold mb-6 text-center">Recuperar Senha</h2>
        <form method="POST" action="/usuario/reset_password"
        onsubmit="return confirm('Tem certeza?')">
            @csrf
            <div class="mb-4">
                <x-input-text id='email' name="email" title="E-mail" type="email" placeholder="Insira o seu e-mail"
                    value="{{ old('email') }}" />
            </div>

            <button type="submit"
                class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Recuperar</button>
        </form>

    </div>
@endsection
