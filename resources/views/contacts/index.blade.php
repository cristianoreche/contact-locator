<x-layout.app>
    <x-shared.alert />

    <div class="uc-page">
        <div class="uc-card">
            <div class="uc-page__header uc-page__header--between">
                <h1 class="uc-page__title">Meus Contatos</h1>

                <div class="uc-page__actions">
                    <a href="{{ route('contacts.create') }}" class="uc-button">
                        + Novo Contato
                    </a>
                    <x-form.button type="button" onclick="window.location='{{ route('contacts.export') }}'"
                        variant="secondary">
                        Exportar Contatos
                    </x-form.button>
                    <x-form.button type="button" onclick="toggleViewMode()" variant="secondary" id="toggleViewButton">
                        Ver Mapa
                    </x-form.button>
                </div>
            </div>

            <form method="GET" class="uc-form uc-form--inline mb-4">
                <input type="text" name="search" class="uc-form__input" placeholder="Buscar por nome ou CPF..."
                    value="{{ request('search') }}">
                <button type="submit" class="uc-button uc-button--secondary">Buscar</button>
            </form>

            <!-- MODO LISTA -->
            <div id="list-view" class="uc-table-responsive uc-table--bordered">
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
                                    @if($contact->latitude && $contact->longitude)
                                        <button class="uc-icon-button" onclick="toggleMap({{ $contact->id }})"
                                            title="Ver no mapa">
                                            <i class="ri-map-pin-line"></i>
                                        </button>
                                    @endif
                                    <a href="{{ route('contacts.edit', $contact->id) }}" class="uc-icon-button"
                                        title="Editar">
                                        <i class="ri-edit-line"></i>
                                    </a>
                                    <button class="uc-icon-button" data-modal-target="modal-{{ $contact->id }}"
                                        title="Excluir">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                    <x-shared.modal id="modal-{{ $contact->id }}" title="Excluir Contato"
                                        :action="route('contacts.destroy', $contact->id)" method="DELETE">
                                        Tem certeza que deseja excluir o contato <strong>{{ $contact->name }}</strong>?
                                    </x-shared.modal>
                                </td>
                            </tr>
                            <tr id="map-row-{{ $contact->id }}" style="display:none;">
                                <td colspan="5">
                                    <x-shared.map :lat="(float) $contact->latitude" :lng="(float) $contact->longitude"
                                        id="map-contact-{{ $contact->id }}" :zoom="15" />
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="5">Nenhum contato encontrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="uc-mt-4">
                    {{ $contacts->links() }}
                </div>
            </div>

            <!-- MODO MAPA -->
            <div id="map-view" style="display: none; height: 600px; border-radius: 8px; overflow: hidden">
                <div id="map-contatos" style="height: 100%;"></div>
            </div>
        </div>
    </div>


    <script>
        function toggleViewMode() {
            const list = document.getElementById('list-view');
            const map = document.getElementById('map-view');
            const btn = document.getElementById('toggleViewButton');

            const isMapVisible = map.style.display !== 'none';

            list.style.display = isMapVisible ? '' : 'none';
            map.style.display = isMapVisible ? 'none' : '';
            btn.innerText = isMapVisible ? 'Ver Mapa' : 'Ver Lista';

            if (!isMapVisible) {
                setTimeout(initMap, 100); // garante que o div já foi exibido
            }
        }

        function initMap() {
            const map = L.map('map-contatos').setView([-25.43, -49.27], 7);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            const contatos = @json($contacts);

            contatos.forEach(contact => {
                if (contact.latitude && contact.longitude) {
                    const marker = L.marker([contact.latitude, contact.longitude]).addTo(map);
                    marker.bindPopup(`<strong>${contact.name}</strong><br>${contact.city} - ${contact.state}`);
                }
            });
        }
    </script>

</x-layout.app>