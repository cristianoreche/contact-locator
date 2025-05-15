<x-layout.auth>
    <x-shared.alert />

    <h1 class="uc-auth__title">Verifique seu E-mail</h1>

    <p class="uc-auth__text mb-4">
        Olá! Antes de continuar, verifique o link que enviamos para <strong>{{ auth()->user()->email }}</strong>.
    </p>

    <p class="uc-auth__text mb-4">
        Caso não tenha recebido, clique abaixo para reenviar:
    </p>

    <x-form.form method="POST" action="{{ route('verification.send') }}">
        <div class="uc-auth__footer">
            <x-form.button full="true" loadingText="Reenviando...">Reenviar E-mail de Verificação</x-form.button>
        </div>
    </x-form.form>

    <p class="uc-auth__text uc-mt-4">
        <x-form.link href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Sair da Conta
        </x-form.link>
    </p>

    <form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">
        @csrf
    </form>
</x-layout.auth>