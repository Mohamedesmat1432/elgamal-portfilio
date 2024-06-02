@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center space-x-2 py-2 px-4 rounded-md text-black hover:bg-gray-500 transition-colors duration-300 text-white font-extrabold bg-gray-400'
            : 'flex items-center space-x-2 py-2 px-4 rounded-md text-black hover:bg-gray-400 transition-colors duration-300 text-white font-bold';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
