@props(['href', 'current' => false, 'aria-current'=>false])
@php
    if ($current){
        $classes = 'bg-gray-900 text-white';
        $ariaCurrent = 'page';
    }else{
        $classes = 'text-gray-500 hover:bg-gray-200';
        $ariaCurrent = 'false';
    }
@endphp

<a href="{{$href}}"
    {{$attributes->merge(['class' => 'rounded-md px-3 py-2 text-sm font-medium transition duration-200 ease-in-out ' . $classes, 'aria-current' => $ariaCurrent])}}>
    {{ $slot }}
</a>
