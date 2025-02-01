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
                {{-- <div class="flex items-center">
                    <input type="checkbox" id="remember" name="remember" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="remember" class="ml-2 block text-sm text-gray-900">Lembrar-me</label>
                </div>
                <a href="#" class="text-sm text-indigo-600 hover:text-indigo-500">Esqueceu sua senha?</a> --}}
            </div>
            @error('usuario')
                <div class="mb-1 text-center">
                    <span class="text-xs text-red-500">{{ $message }}</span>
                </div>
            @enderror
            <button type="submit"
                class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Entrar</button>
        </form>
        {{--  <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">Não tem uma conta? <a href="#" class="text-indigo-600 hover:text-indigo-500">Cadastre-se</a></p>
        </div> --}}
    </div>
@endsection
