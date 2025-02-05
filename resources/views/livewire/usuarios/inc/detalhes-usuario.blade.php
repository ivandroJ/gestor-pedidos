<div class="mb-4 md:w-1/3 sm:w-full px-2">
                <div class="flex justify-between items-center text-white bg-red-500 rounded-t-lg shadow-lg">
                    <div class="p-2">
                        <h4 class="text-xl">Detalhes</h4>
                    </div>
                </div>
                <div id="detalhes" class="bg-white rounded-b-lg shadow-lg w-full">
                    <div class="p-6">

                        <div class="grid flex-wrap -mx-4">
                            <div class="mb-5 md:w-full px-2 py-1">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
                                <span class="text-lg">{{ $usuario->nome }}</span>
                            </div>

                            <div class="mb-5 md:w-full px-2 py-1 border-t-2 pt-3">
                                <label class="block text-sm font-medium text-gray-700 mb-1">E-Mail</label>
                                <span class="text-lg">{{ $usuario->email }}</span>

                            </div>

                            <div class="mb-5 md:w-full px-2 py-1 border-t-2 pt-3">

                                <label class="block text-sm font-medium text-gray-700 mb-1">Perfil</label>
                                <x-pill :label="$usuario->perfil"></x-pill>
                            </div>

                            @if ($usuario->isSolicitante())
                                <div class="mb-5 md:w-full px-2 py-1 border-t-2 pt-3">

                                    <label class="block text-sm font-medium text-gray-700 mb-1">Grupo</label>
                                    <span class="text-lg">{{ $usuario->solicitante->grupo->nome }}</span>

                                </div>
                            @endif
                        </div>
                        @if (Auth::user()->id != $usuario->id)
                            <div class="flex flex-wrap -mx-4">
                                <div class="md:w-full px-2 py-1 border-t-2 pt-3">
                                    @if ($usuario->reseted_password)
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Senha
                                            Temporária</label>
                                        <span>{{ $usuario->reseted_password }}</span>
                                    @else
                                        <form action="/usuario/reset_password" method="POST"
                                            onsubmit="return confirm('Tem certeza?')">
                                            @csrf
                                            <input type="hidden" name='usuario_id' value="{{ $usuario->id }}">
                                            <x-button color="green" type="submit" class="text-sm w-full sm:w-full"
                                                px='2' py="2">
                                                Reiniciar Senha
                                            </x-button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
