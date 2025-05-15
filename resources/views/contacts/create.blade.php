<x-layout.app>
    <x-shared.alert />

    <div class="uc-page">
        <div class="uc-card">
            <h1 class="uc-page__title">Novo Contato</h1>
            <x-form.form method="POST" action="{{ route('contacts.store') }}">
                <input type="hidden" name="latitude" value="{{ old('latitude', $contact->latitude ?? '') }}">
                <input type="hidden" name="longitude" value="{{ old('longitude', $contact->longitude ?? '') }}">

                <div class="uc-form__row">
                    <x-form.input name="name" label="Nome" required />
                    <x-form.input name="cpf" label="CPF" required />
                    <x-form.input name="phone" label="Telefone" required />
                </div>

                <div class="uc-form__row">
                    <x-form.input name="cep" label="CEP" required />
                    <x-form.input name="state" label="Estado" required />
                    <x-form.input name="city" label="Cidade" required />
                </div>

                <div class="uc-form__row">
                    <x-form.input name="bairro" label="Bairro" />
                    <x-form.input name="street" label="Rua" required />
                    <x-form.input name="number" label="Número" required />
                </div>

                <x-form.input name="complement" label="Complemento" />

                <div class="uc-mt-4">
                    <x-form.button loadingText="Salvando...">Salvar Contato</x-form.button>
                    <a href="{{ route('contacts.index') }}" class="uc-button uc-button--secondary">
                        Voltar
                    </a>
                </div>
            </x-form.form>
        </div>
    </div>

    <x-shared.modal id="modal-cep-error" title="CEP inválido" method="GET" action="#">
        O CEP informado não foi encontrado. Verifique se digitou corretamente.
    </x-shared.modal>

</x-layout.app>