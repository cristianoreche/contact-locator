<x-layout.auth>
    <x-shared.alert />

    <h1 class="uc-auth__title">Acessar Sistema</h1>

    <x-form.form method="POST" action="{{ route('login') }}">
        <x-form.input name="email" label="E-mail" type="email" required />
        <x-form.input name="password" label="Senha" type="password" required />

        <div class="uc-auth__actions">
            <x-form.link href="{{ route('password.request') }}">Esqueci minha senha</x-form.link>
        </div>

        <div class="uc-auth__footer">
            <x-form.button full="true" loadingText="Entrando...">Entrar</x-form.button>
        </div>
    </x-form.form>

    <p class="uc-auth__text uc-mt-4">
        Não tem conta?
        <x-form.link href="{{ route('register') }}">Cadastre-se</x-form.link>
    </p>
</x-layout.auth>