<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Autenticação' }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="uc-auth">
    {{ $slot }}
</body>
</html>
