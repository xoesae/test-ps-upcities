@props([
    'name',
    'label',
    'validationName' => null,
])

<div class="flex flex-col">
    <label for="{{ $name }}" class="text-gray-700 font-semibold">{{ $label }}</label>
    <select id="{{ $name }}" name="{{ $name }}" value="{{ old($validationName ?? $name) }}" class="border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        {{ $slot }}
    </select>
    @error($validationName ?? $name)
        <span class="text-red-500 text-sm m-0">{{ $message }}</span>
    @enderror
</div>