@props(['active'])

@php
$classes = ($active ?? false)
    ? 'inline-flex items-center px-1 pt-1 border-b-2 border-blue-600 text-gray-800 text-sm font-medium leading-5 focus:outline-none focus:border-blue-600 transition'
    : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-gray-800 text-sm font-medium leading-5 hover:text-gray-700 hover:border-blue-400 focus:outline-none focus:text-gray-700 focus:border-blue-400 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
