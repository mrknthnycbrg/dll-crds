@props(['active'])

@php
    $classes = $active ?? false ? 'block w-full pl-3 pr-4 py-2 border-l-4 border-yellow-500 text-left text-base font-bold text-yellow-500 bg-blue-950 focus:outline-none focus:text-yellow-500 focus:bg-blue-950 focus:border-yellow-500 transition duration-150 ease-in-out' : 'block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-left text-base font-medium text-gray-100 hover:text-yellow-500 hover:bg-blue-950 hover:border-yellow-500 focus:outline-none focus:text-yellow-500 focus:bg-blue-950 focus:border-yellow-500 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
