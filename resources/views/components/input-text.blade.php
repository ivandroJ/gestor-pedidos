<div>
    <label for="{{ $id }}" class="block text-sm font-medium text-gray-700">{{ $title }} <span class="text-red-500">*</span></label>
    <input type="{{ $type }}" id="{{ $id }}" name="{{ $name }}" {!! $is_live ?? '' !!}
        class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm
  border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500
        sm:text-sm"
        placeholder="{{ $placeholder }}" value="{{ $value }}">

    @error($name)
        <span class="text-xs text-red-500">{{ $message }}</span>
    @enderror
</div>
