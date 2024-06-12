@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'py-1 px-2 border-gray-500 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm']) !!}>
