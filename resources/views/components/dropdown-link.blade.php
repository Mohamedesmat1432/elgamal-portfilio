@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full px-4 py-2 text-start text-sm leading-5 text-white hover:bg-blue-600 focus:outline-none focus:bg-blue-600 transition duration-150 ease-in-out bg-blue-500 text-white'
            : 'block w-full px-4 py-2 text-start text-sm leading-5 text-gray-800 hover:bg-gray-400 focus:outline-none focus:bg-gray-400 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
