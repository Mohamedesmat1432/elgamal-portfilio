@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center space-x-2 py-2 px-4 rounded-md text-white hover:bg-blue-600 transition-colors duration-300 font-extrabold bg-blue-500'
            : 'flex items-center space-x-2 py-2 px-4 rounded-md text-white hover:bg-gray-400 transition-colors duration-300 font-bold';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
