<x-layout.app>
    <x-shared.alert />

    <div class="uc-page">
        <h1 class="uc-page__title">Editar Contato</h1>

        <form method="POST" action="{{ route('contacts.update', $contact->id) }}" class="uc-form">
            @csrf
            @method('PUT')

            <div class="uc-form__grid">
                <x-form.input name="name" label="Nome" :value="$contact->name" required />
                <x-form.input name="cpf" label="CPF" :value="$contact->cpf" required />
                <x-form.input name="phone" label="Telefone" :value="$contact->phone" required />
            </div>

            <div class="uc-form__grid">
                <x-form.input name="cep" label="CEP" :value="$contact->cep" required />
                <x-form.input name="state" label="Estado" :value="$contact->state" required />
                <x-form.input name="city" label="Cidade" :value="$contact->city" required />
            </div>

            <div class="uc-form__grid">
                <x-form.input name="bairro" label="Bairro" :value="$contact->bairro" />
                <x-form.input name="street" label="Rua" :value="$contact->street" required />
                <x-form.input name="number" label="Número" :value="$contact->number" required />
            </div>

            <x-form.input name="complement" label="Complemento" :value="$contact->complement" />

            <div class="mt-4">
                <button type="submit" class="uc-button">Atualizar Contato</button>
            </div>
        </form>
    </div>
</x-layout.app>
