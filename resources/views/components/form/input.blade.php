@props([
    'name',
    'placeholder',
    'value',
    'type' => 'text',
    'validationName' => null,
])

<div class="flex flex-col">
    <label for="{{ $name }}" class="text-gray-700 font-semibold">{{ $slot }}</label>
    <input 
        type="{{ $type }}" 
        placeholder="{{ $placeholder }}" 
        name="{{ $name }}" 
        id="{{ $name }}" 
        value="{{ old($validationName ?? $name, null) ?? $value }}"
        class="border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
    >
    @error($validationName ?? $name)
        <span class="text-red-500 text-sm m-0">{{ $message }}</span>
    @enderror
</div>