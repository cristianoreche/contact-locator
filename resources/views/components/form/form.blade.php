<form
    method="{{ $method ?? 'POST' }}"
    action="{{ $action ?? '' }}"
    class="uc-form {{ $class ?? '' }}"
    {{ $attributes }}
>
    @csrf

    @if(isset($method) && in_array(strtoupper($method), ['PUT', 'PATCH', 'DELETE']))
        @method($method)
    @endif

    {{ $slot }}
</form>
