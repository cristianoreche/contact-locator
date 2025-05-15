<form
    method="POST"
    action="{{ $action ?? '' }}"
    class="uc-form {{ $class ?? '' }}"
    {{ $attributes }}
>
    @csrf

    {{-- Injeta método falso se necessário --}}
    @if(isset($method) && in_array(strtoupper($method), ['PUT', 'PATCH', 'DELETE']))
        @method($method)
    @endif

    {{ $slot }}
</form>
