<x-layout.auth>
    <x-shared.alert />

    <h1 class="uc-auth__title">Recuperar Senha</h1>
    <p class="uc-auth__text mb-4">
        Informe seu e-mail cadastrado e enviaremos um link para redefinir sua senha.
    </p>

    <x-form.form method="POST" action="{{ route('password.email') }}">
        <x-form.input name="email" label="E-mail" type="email" required />

        <div class="uc-auth__footer">
            <x-form.button full="true" loadingText="Enviando...">Enviar Link</x-form.button>
        </div>
    </x-form.form>

    <p class="uc-auth__text uc-mt-4">
        <x-form.link href="{{ route('login') }}">Voltar ao login</x-form.link>
    </p>
</x-layout.auth>