@props(['active'])

@php
$classes = ($active ?? false)
    ? 'block px-4 py-2 text-gray-800 text-sm font-medium leading-5 bg-white focus:outline-none focus:bg-blue-100 focus:text-blue-600'
    : 'block px-4 py-2 text-gray-800 text-sm font-medium leading-5 hover:bg-blue-50 hover:text-blue-600 focus:outline-none focus:bg-blue-100 focus:text-blue-600 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
