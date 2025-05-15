<x-layout.app>
    <x-shared.alert />

    <div class="uc-page">
        <div class="uc-page__header">
            <h1 class="uc-page__title">Meus Contatos</h1>

            <a href="{{ route('contacts.create') }}" class="uc-button">
                + Novo Contato
            </a>
        </div>

        <form method="GET" class="uc-form uc-form--inline mb-4">
            <input type="text" name="search" class="uc-form__input" placeholder="Buscar por nome ou CPF..." value="{{ request('search') }}">
            <button type="submit" class="uc-button uc-button--secondary">Buscar</button>
        </form>

        <div class="uc-table-responsive uc-table--bordered">
            <table class="uc-table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Telefone</th>
                        <th>Cidade</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($contacts as $contact)
                        <tr>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->cpf }}</td>
                            <td>{{ $contact->phone }}</td>
                            <td>{{ $contact->city }} / {{ $contact->state }}</td>
                            <td>
                                <a href="{{ route('contacts.edit', $contact->id) }}" class="uc-icon-button" title="Editar">
                                    <i class="ri-edit-line"></i>
                                </a>
                                <button class="uc-icon-button" data-modal-target="modal-{{ $contact->id }}" title="Excluir">
                                    <i class="ri-delete-bin-line"></i>
                                </button>

                                <x-shared.modal
                                    id="modal-{{ $contact->id }}"
                                    title="Excluir Contato"
                                    :action="route('contacts.destroy', $contact->id)"
                                    method="DELETE"
                                >
                                    Tem certeza que deseja excluir o contato <strong>{{ $contact->name }}</strong>?
                                </x-shared.modal>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">Nenhum contato encontrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $contacts->links() }}
        </div>
    </div>
</x-layout.app>
