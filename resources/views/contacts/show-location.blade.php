<x-layout.app>
    <div class="uc-page">
        <h1 class="uc-page__title">Localização de {{ $contact->name }}</h1>

        @if ($contact->latitude && $contact->longitude)
            <x-shared.map :lat="$contact->latitude" :lng="$contact->longitude" id="contact-map" />
        @else
            <p class="text-muted mt-4">Este contato ainda não possui coordenadas geográficas registradas.</p>
        @endif

        <div class="mt-4">
            <a href="{{ route('contacts.index') }}" class="uc-button uc-button--secondary">Voltar</a>
        </div>
    </div>
</x-layout.app>
