@component('mail::message')
# Verifique seu e-mail

Clique no botão abaixo para confirmar seu endereço de e-mail e ativar sua conta:

@component('mail::button', ['url' => $url])
Verificar e-mail
@endcomponent

Se você não criou essa conta, ignore este e-mail.

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
