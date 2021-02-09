@props(['light'])

@php
    $classes = ($light ?? false)
                ? 'inline-flex items-center px-4 py-2 bg-cyan-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-light-blue-500 active:bg-light-blue-700 focus:outline-none focus:border-light-blue-900 focus:ring ring-light-blue-300 disabled:opacity-25 transition ease-in-out duration-150'
                : 'inline-flex items-center px-4 py-2 bg-light-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150';
@endphp

<button {{ $attributes->merge(['type' => 'submit', 'class' => $classes]) }}>
    {{ $slot }}
</button>
