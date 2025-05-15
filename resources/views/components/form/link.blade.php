<a
    href="{{ $href }}"
    class="uc-link @if(isset($variant) && $variant === 'danger') uc-link--danger @endif"
>
    {{ $slot }}
</a>
