@props(['active'])
@php
$classes = ($active ?? false)
            ? 'bg-slate-600 rounded-lg inline-flex items-center px-5 py-2 text-sm font-bold leading-5 text-white focus:outline-none focus:ring ring-blue-300 transition ease-in-out duration-150'
            : 'rounded-lg inline-flex items-center px-5 py-2 text-sm font-medium leading-5 text-slate-500 hover:text-slate-100 hover:bg-slate-600 hover:text-white focus:outline-none focus:ring ring-blue-300 focus:text-white focus:bg-slate-600 transition ease-in-out duration-150';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
