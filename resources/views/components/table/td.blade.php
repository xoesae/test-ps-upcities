@props([
    'class' => '',
    'colSpan' => '1',
])

<td class="whitespace-nowrap px-6 py-2 font-medium {{ $class }}" colspan="{{ $colSpan }}">{{ $slot }}</td>