<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Autenticação' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="uc-auth">
    {{ $slot }}
</body>
<script src="{{ asset('js/components/_togglePassword.js') }}"></script>
<script src="{{ asset('js/components/_button.js') }}"></script>
<script src="{{ asset('js/components/_alert.js') }}"></script>

</html>