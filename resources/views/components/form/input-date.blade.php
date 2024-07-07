@props([
    'name',
    'value',
])

<div class="flex flex-col min-w-full">
    <label for="{{ $name }}" class="text-gray-700 font-semibold">{{ $slot }}</label>
    <input 
        type="date" 
        id="{{ $name }}" 
        name="{{ $name }}"
        value="{{ old($name, null) ?? \Carbon\Carbon::parse($value)->format('Y-m-d') }}" 
        class="border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
    >
    @error($name)
        <span class="text-red-500 text-sm m-0">{{ $message }}</span>
    @enderror
</div>