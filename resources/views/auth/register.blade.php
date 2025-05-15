<x-layout.auth>
    <x-shared.alert />

    <div class="uc-auth">
        <h1 class="uc-auth__title">Criar Conta</h1>

        <x-form.form method="POST" action="{{ route('register') }}">
            <x-form.input name="name" label="Nome" required />
            <x-form.input name="email" label="E-mail" type="email" required />
            <x-form.input name="password" label="Senha" type="password" required />
            <x-form.input name="password_confirmation" label="Confirmar Senha" type="password" required />

            <div class="uc-auth__footer">
                <x-form.button full="true">Registrar</x-form.button>
            </div>
        </x-form.form>

        <p class="uc-auth__text mt-4">
            Já possui conta?
            <x-form.link href="{{ route('login') }}">Entrar</x-form.link>
        </p>
    </div>
</x-layout.auth>