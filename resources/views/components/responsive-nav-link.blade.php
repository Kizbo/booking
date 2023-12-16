@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 text-start text-base font-medium focus:outline-none bg-gray-50 focus:bg-indigo-100 text-black transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 text-start text-base font-medium text-gray-400  hover:text-gray-800 :text-gray-200 hover:bg-gray-50 :bg-gray-700 hover:border-gray-300 :border-gray-600 focus:outline-none focus:text-gray-800 :text-gray-200 focus:bg-gray-50 :bg-gray-700 focus:border-gray-300 :border-gray-600 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
