@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-300 focus:border-blue-300 focus:ring focus:ring-blue-300 focus:ring-opacity-50 dark:bg-slate-800 dark:border-slate-600 dark:focus:ring-blue-300 dark:text-slate-100']) !!}>
