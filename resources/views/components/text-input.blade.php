@props(['disabled' => false])

{{-- <input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}> --}}



<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'w-full border border-blue-border rounded  py-2 mt-2  text-black-light  bg-blue-dark bg-opacity-10 ']) !!}>
