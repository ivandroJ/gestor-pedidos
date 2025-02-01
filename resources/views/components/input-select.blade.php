<div>
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">{{ $title }}</label>
        <select name="{{ $name }}" id="{{ $id }}"
            class="mt-1 block w-full px-3 py-2 border  rounded-md shadow-sm
  border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500
        sm:text-sm">
            <option value="" hidden>(Selecione uma opção)</option>
            @foreach ($itens as $item)
                <option value="{{ $item }}" {{ $item == $value ? 'selected' : '' }}>{{ $item }}</option>
            @endforeach
        </select>
        @error($name)
            <span class="text-xs text-red-500">{{ $message }}</span>
        @enderror
    </div>
</div>
