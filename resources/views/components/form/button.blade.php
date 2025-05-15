<button
    type="{{ $type ?? 'submit' }}"
    class="uc-button
        @if(isset($variant) && $variant === 'secondary') uc-button--secondary @endif
        @if(isset($variant) && $variant === 'danger') uc-button--danger @endif
        @if(!empty($full)) w-full @endif"
>
    {{ $slot }}
</button>
