@component('mail::message')
# Bem-vindo, {{ $user->name }}!

Sua conta foi ativada com sucesso.

Agora você pode acessar o sistema normalmente usando seu e-mail e senha.

Obrigado por fazer parte!

@component('mail::button', ['url' => route('dashboard')])
Acessar Dashboard
@endcomponent

@endcomponent
