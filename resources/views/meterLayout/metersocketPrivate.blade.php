<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user-id" content="{{ $MID }}">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/meterJs/meterapp.js'])

</head>

<body>
    <h1>{{ $MID }}</h1>
    {{-- sending a random data to server using inline alpinsjs --}}
    <div x-data="{ data: '0' }" x-init=" await (setInterval(() => {
         data = Math.random() * (0.003 - 0.001) + 0.001;
         data = data.toFixed(8);
         fetch('{{ route('metersocketPrivate') }}', {
             method: 'POST',
             headers: {
                 'Content-Type': 'application/json',
                 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content')
             },
             body: JSON.stringify({ data: data })
         });
     }, 1500))">
        <p x-text="data"></p>

    </div>





</body>

</html>
