@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden w-96">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h4 class="text-xl">Definir Nova Senha</h4>
                </div>
                <form action="/usuario/set_password" method="POST" onsubmit="return confirm('Tem certeza?')">
                    @csrf
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
                        <input type="password" id="password" name="password"
                            class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            placeholder="Insira a nova Senha">

                        @error('password')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="password2" class="block text-sm font-medium text-gray-700">Senha Novamente</label>
                        <input type="password" id="password2" name="password2"
                            class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            placeholder="Insira a Senha novamente">

                        @error('password2')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <x-button type="submit" color="blue" color_tone='600' px="4" py="2"
                            class="w-full">
                            Alterar</x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
