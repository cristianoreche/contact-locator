<x-layout.app>
    <x-shared.alert />

    <div class="uc-page">
        <div class="uc-card">
            <h1 class="uc-page__title">Editar Contato</h1>

            <x-form.form method="PUT" action="{{ route('contacts.update', $contact->id) }}">
                <input type="hidden" name="latitude" value="{{ old('latitude', $contact->latitude ?? '') }}">
                <input type="hidden" name="longitude" value="{{ old('longitude', $contact->longitude ?? '') }}">

                <div class="uc-form__row">
                    <x-form.input name="name" label="Nome" :value="$contact->name" required />
                    <x-form.input name="cpf" label="CPF" :value="$contact->cpf" required />
                    <x-form.input name="phone" label="Telefone" :value="$contact->phone" required />
                </div>

                <div class="uc-form__row">
                    <x-form.input name="cep" label="CEP" :value="$contact->cep" required />
                    <x-form.input name="state" label="Estado" :value="$contact->state" required />
                    <x-form.input name="city" label="Cidade" :value="$contact->city" required />
                </div>

                <div class="uc-form__row">
                    <x-form.input name="bairro" label="Bairro" :value="$contact->bairro" />
                    <x-form.input name="street" label="Rua" :value="$contact->street" required />
                    <x-form.input name="number" label="Número" :value="$contact->number" required />
                </div>

                <x-form.input name="complement" label="Complemento" :value="$contact->complement" />

                <div class="uc-mt-4">
                    <x-form.button loadingText="Atualizando...">Atualizar Contato</x-form.button>
                    <a href="{{ route('contacts.index') }}" class="uc-button uc-button--secondary">
                        Voltar
                    </a>
                </div>
            </x-form.form>

        </div>
        <x-shared.modal id="modal-cep-error" title="CEP inválido" method="GET" action="#">
            O CEP informado não foi encontrado. Verifique se digitou corretamente.
        </x-shared.modal>

</x-layout.app>