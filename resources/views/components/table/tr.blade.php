@props([
    'isStripe' => false,
])

<tr class="border-b border-neutral-200 {{ $isStripe ? 'bg-black/[0.02]' : 'bg-white' }}">
    {{ $slot }}
</tr>