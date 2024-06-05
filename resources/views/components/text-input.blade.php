@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'py-1 px-2 border-gray-300 focus:border-gray-500 focus:ring-gray-500 rounded-md shadow-sm']) !!}>
