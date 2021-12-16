@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block pl-3 pr-4 py-4 border-l-4 border-indigo-400 text-base font-medium text-indigo-700 bg-white focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700 transition duration-150 ease-in-out'
            : 'block pl-3 pr-4 py-4 text-base font-medium text-gray-200 hover:text-gray-800 hover:bg-gray-50 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
