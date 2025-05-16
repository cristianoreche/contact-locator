<div class="uc-form__group">
    <input type="text" name="{{ $name }}" id="{{ $id ?? $name }}" value="{{ old($name, request($name)) }}"
        placeholder="{{ $placeholder ?? 'Buscar...' }}" class="uc-form__input fieldSearch" autocomplete="off">
</div>
<div class="search__results"></div>
@push('scripts')
    <script src="{{ asset('js/components/_search.js') }}"></script>
@endpush