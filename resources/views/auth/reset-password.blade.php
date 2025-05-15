<x-layout.auth>
    <x-shared.alert />

    <div class="uc-auth">
        <h1 class="uc-auth__title">Criar Nova Senha</h1>

        <x-form.form method="POST" action="{{ route('password.update') }}">
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ request('email') }}">

            <x-form.input name="password" label="Nova Senha" type="password" required />
            <x-form.input name="password_confirmation" label="Confirmar Senha" type="password" required />

            <div class="uc-auth__footer">
                <x-form.button full="true">Redefinir Senha</x-form.button>
            </div>
        </x-form.form>

        <p class="uc-auth__text mt-4">
            <x-form.link href="{{ route('login') }}">Voltar ao login</x-form.link>
        </p>
    </div>
</x-layout.auth>