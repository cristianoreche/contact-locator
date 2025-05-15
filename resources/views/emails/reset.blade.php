<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Redefinição de Senha</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9fafb;
            color: #111827;
            padding: 2rem;
        }

        .email-container {
            max-width: 500px;
            margin: auto;
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        h1 {
            font-size: 1.5rem;
            color: #111827;
        }

        p {
            margin-top: 1rem;
            font-size: 0.95rem;
        }

        .button {
            display: inline-block;
            margin-top: 2rem;
            padding: 0.75rem 1.5rem;
            background-color: #2563eb;
            color: #fff;
            text-decoration: none;
            border-radius: 0.5rem;
            font-weight: bold;
        }

        .footer {
            margin-top: 2rem;
            font-size: 0.875rem;
            color: #6b7280;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h1>Redefinição de Senha</h1>

        <p>Olá,</p>

        <p>Recebemos uma solicitação para redefinir sua senha. Clique no botão abaixo para escolher uma nova senha:</p>

        <a href="{{ $resetUrl }}" class="button">Redefinir Senha</a>

        <p class="footer">
            Se você não solicitou essa alteração, ignore este e-mail.<br>
            Este link é válido por 60 minutos.
        </p>
    </div>
</body>
</html>
