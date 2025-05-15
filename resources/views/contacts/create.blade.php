<x-layout.app>
    <x-shared.alert />

    <div class="uc-page">
        <h1 class="uc-page__title">Novo Contato</h1>

        <form method="POST" action="{{ route('contacts.store') }}" class="uc-form">
            @csrf

            <div class="uc-form__grid">
                <x-form.input name="name" label="Nome" required />
                <x-form.input name="cpf" label="CPF" required />
                <x-form.input name="phone" label="Telefone" required />
            </div>

            <div class="uc-form__grid">
                <x-form.input name="cep" label="CEP" required />
                <x-form.input name="state" label="Estado" required />
                <x-form.input name="city" label="Cidade" required />
            </div>

            <div class="uc-form__grid">
                <x-form.input name="bairro" label="Bairro" />
                <x-form.input name="street" label="Rua" required />
                <x-form.input name="number" label="Número" required />
            </div>

            <x-form.input name="complement" label="Complemento" />

            <div class="mt-4">
                <button type="submit" class="uc-button">Salvar Contato</button>
            </div>
        </form>
    </div>
</x-layout.app>
