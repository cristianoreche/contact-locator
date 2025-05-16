<x-layout.app>
    <x-shared.alert />

    <div class="uc-page">
        <div class="uc-card">



            <style>
                .uc-card__search-bar {
                    width: 100%;
                    margin: 1rem 0;
                }


                .uc-card__container {
                    display: grid;
                    grid-template-columns: 1fr;
                    gap: 1.5rem;
                    margin-top: 1rem;
                }

                .uc-card__table-section {
                    width: 100%;
                }

                /* Mapa */
                .uc-card__map {
                    width: 100%;
                    height: 400px;
                    border-radius: var(--radius-md);
                    overflow: hidden;
                    border: 1px solid var(--border);
                }


                @media (min-width: 1024px) {
                    .uc-card__container {
                        grid-template-columns: 1fr 1fr;
                        align-items: start;
                    }

                    .uc-card__map {
                        height: 600px;
                    }
                }
            </style>


            <div class="uc-card__header">
                <h2 class="uc-card__title">Meus Contatos</h2>
                <div class="uc-card__actions">
                    <a href="{{ route('contacts.create') }}" class="uc-button">+ Novo Contato</a>

                </div>
            </div>

            <div class="uc-card__search-bar">
                <div class="uc-form__row grouped-row">
                    <x-shared.search name="search" placeholder="Pesquisar por nome ou CPF..." />
                    <a href="{{ route('contacts.export', ['search' => request('search')]) }}"
                        class="uc-button uc-button--info">
                        Exportar CSV
                    </a>

                    <a href="{{ route('contacts.export.pdf', ['search' => request('search')]) }}"
                        class="uc-button uc-button--success">
                        Exportar PDF
                    </a>
                </div>
            </div>

            <div class="uc-card__search-bar">
                <form method="GET" class="uc-form__row grouped-row">
                    <select name="city" class="uc-form__input">
                        <option value="">Todas as Cidades</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city }}" @selected(request('city') == $city)>{{ $city }}</option>
                        @endforeach
                    </select>

                    <select name="state" class="uc-form__input">
                        <option value="">Todos os Estados</option>
                        @foreach ($states as $state)
                            <option value="{{ $state }}" @selected(request('state') == $state)>{{ $state }}</option>
                        @endforeach
                    </select>

                    <button type="submit" class="uc-button uc-button--secondary">Filtrar</button>
                    <a href="{{ route('contacts.index') }}" class="uc-button uc-button--secondary">Limpar</a>
                </form>
            </div>

            <div class="uc-card__container">

                <!-- TABELA -->
                <div class="uc-card__table-section">


                    <div class="uc-card__table">
                        <x-shared.table :columns="[
        'name' => 'Nome',
        'phone' => 'Telefone',
    ]" :items="$contacts"
                            :actions="true" />
                        <x-shared.pagination :paginator="$contacts" />
                    </div>
                </div>

                <!-- MAPA -->
                <div class="uc-card__map">
                    <div id="map-contatos-lateral" style="height: 100%; width: 100%;"></div>
                </div>
            </div>

        </div>
    </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const map = L.map('map-contatos-lateral', {
                    fullscreenControl: true,
                    fullscreenControlOptions: {
                        position: 'topleft'
                    }
                }).setView([-25.43, -49.27], 7);

                const streetLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(map);

                const satelliteLayer = L.tileLayer(
                    'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                    attribution: 'Tiles © Esri'
                }
                );

                L.control.layers({
                    'Rua': streetLayer,
                    'Satélite': satelliteLayer
                }).addTo(map);

                const contatos = @json($contacts->items());

                contatos.forEach(contact => {
                    if (contact.latitude && contact.longitude) {
                        const whatsapp = contact.phone
                            ? `<br><strong><i class="ri-whatsapp-line"></i> WhatsApp:</strong> <a href="https://wa.me/55${contact.phone.replace(/\D/g, '')}" target="_blank">${contact.phone}</a>`
                            : '';

                        const marker = L.marker([contact.latitude, contact.longitude]).addTo(map);
                        marker.bindPopup(
                            `<strong>${contact.name}</strong><br>${contact.city} - ${contact.state}${whatsapp}`
                        );
                    }
                });

                window.centerMap = function (lat, lng, name) {
                    map.setView([lat, lng], 15);
                    L.popup()
                        .setLatLng([lat, lng])
                        .setContent(`<strong>${name}</strong>`)
                        .openOn(map);
                };
            });
        </script>
    @endpush
</x-layout.app>