<div id="map-{{ $id }}" class="uc-map" style="height: 300px; border-radius: 0.75rem; overflow: hidden;"></div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const map = L.map('map-{{ $id }}').setView([{{ $lat }}, {{ $lng }}], {{ $zoom ?? 13 }});

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        L.marker([{{ $lat }}, {{ $lng }}]).addTo(map);
    });
</script>
@endpush
