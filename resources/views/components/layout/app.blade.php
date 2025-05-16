<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Painel' }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.fullscreen/Control.FullScreen.css" />

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">


</head>

<body class="uc-app">
    <x-shared.header />
    <x-shared.main>
        {{ $slot }}
    </x-shared.main>
</body>

<script src="https://unpkg.com/imask"></script>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet.fullscreen/Control.FullScreen.js"></script>


<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/components/_togglePassword.js') }}"></script>
<script src="{{ asset('js/components/_button.js') }}"></script>
<script src="{{ asset('js/components/_modal.js') }}"></script>
<script src="{{ asset('js/components/_alert.js') }}"></script>
<script src="{{ asset('js/components/_header.js') }}"></script>
@stack('scripts')

</html>