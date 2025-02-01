<div>
    <form wire:submit.prevent = "save">
        @csrf
        <div class="mb-4">
            <label for="nome" class="block text-sm font-medium text-gray-700">
                Nome <span class="text-red-500">*</span>
            </label>
            <input type="text" id="nome" wire:model.defer='usuario.nome'
                class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                placeholder="Insira o nome">

            @error('usuario.nome')
                <span class="text-xs text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">E-Mail <span class="text-red-500">*</span></label>
            <input type="text" id="email" wire:model.defer='usuario.email'
                class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                placeholder="Insira o e-mail">

            @error('usuario.email')
                <span class="text-xs text-red-500">{{ $message }}</span>
            @enderror
        </div>

        @if (!$is_primeira_vez)
            <div class="mb-4">
                <label for="perfil" class="block text-sm font-medium text-gray-700">Perfil
                    <span class="text-red-500">*</span>
                </label>
                <select id="perfil" wire:model.lazy='usuario.perfil'
                    class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

                    <option value="" hidden>(Selecione uma opção)</option>

                    @foreach ($perfis as $perfil)
                        <option value="{{ $perfil }}">{{ $perfil }}</option>
                    @endforeach

                </select>

                @error('usuario.perfil')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>
        @else
            <input type="hidden" name="perfil" value="{{ Config::get('constants.PERFIS.aprovador') }}">
        @endif

        @if ($usuario['perfil'] == Config::get('constants.PERFIS.solicitante'))
            <div class="mb-4">
                <label for="grupo" class="block text-sm font-medium text-gray-700">Grupo <span class="text-red-500">*</span></label>
                <select id="grupo" wire:model.defer='usuario.grupo_id'
                    class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="" hidden>(Selecione uma opção)</option>
                    @foreach ($grupos as $grupo)
                        <option value="{{ $grupo->id }}">{{ $grupo->nome }}</option>
                    @endforeach
                </select>
                @error('usuario.grupo_id')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>
        @endif

        @error('usuario')
            <div class="mb-1 text-center">
                <span class="text-xs text-red-500">{{ $message }}</span>
            </div>
        @enderror
        <button type="submit" onclick="return confirm('Tem certeza?')"
            class="w-full bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
            <i class="fas fa-check"></i>
            Cadastrar</button>
    </form>
</div>
