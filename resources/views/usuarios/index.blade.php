@extends('layouts.app')

@section('content')
    <div class="bg-white rounded-lg shadow-lg overflow-hidden w-full">
        <div class="p-6">
            <div class="flex justify-end mb-4">
                <button id="openModal" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                    <i class="fas fa-plus"></i>
                    Novo
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nome
                            </th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Perfil
                            </th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        @foreach ($usuarios as $usuario)
                            <tr class="hover:bg-indigo-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $usuario->nome }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="text-sm text-gray-900">

                                        <x-pill :label="$usuario->perfil"></x-pill>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">

                                    <a href="{{ url('/usuarios/'.$usuario->id) }}" class="bg-blue-400 text-white px-2 py-1 rounded-lg hover:bg-blue-600 text-sm">
                                        <i class="fas fa-list"></i>
                                        Detalhes
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>


    @include('usuarios.modals.create')
@endsection
