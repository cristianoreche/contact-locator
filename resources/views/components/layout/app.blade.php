<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Painel' }}</title>
    
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

</head>

<body class="uc-app">
    <x-shared.header />
    <x-shared.main>
        {{ $slot }}
    </x-shared.main>
</body>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="{{ asset('js/components/_modal.js') }}"></script>
<script src="{{ asset('js/components/_alert.js') }}"></script>
<script src="{{ asset('js/components/_header.js') }}"></script>
@stack('scripts')
</html>