@props(['active'])
@php
$classes = ($active ?? false)
            ? 'bg-slate-600 rounded-full inline-flex items-center px-5 py-2 text-sm font-medium leading-5 text-white focus:outline-none focus:ring ring-blue-300 transition ease-in-out duration-150'
            : 'rounded-full inline-flex items-center px-5 py-2 text-sm font-medium leading-5 text-slate-500 hover:text-slate-100 hover:bg-slate-600 hover:text-white focus:outline-none focus:ring ring-blue-300 focus:text-white focus:bg-slate-600 transition ease-in-out duration-150';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    @if ($active)
    <span class="bg-slate-700 rounded-full py-1 px-2 inline-block mr-2 text-xs transition ease-in-out duration-150">ADMIN</span>
    @else
    <span class="bg-slate-200 rounded-full py-1 px-2 inline-block mr-2 text-xs group-hover:bg-slate-700 group-focus:bg-slate-700 transition ease-in-out duration-150">ADMIN</span>
    @endif
    {{ $slot }}
</a>
