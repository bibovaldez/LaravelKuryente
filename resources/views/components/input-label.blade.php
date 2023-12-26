{{-- @props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700']) }}>
    {{ $value ?? $slot }}
</label> --}}

@props(['value'])

<label {{ $attributes->merge(['class' => 'font-openSans text-black-light opacity-80 font-medium text-xl tracking-tight ']) }}>
    {{ $value ?? $slot }}
</label>