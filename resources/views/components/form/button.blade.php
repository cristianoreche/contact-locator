<button
    type="{{ $type }}"
    class="uc-button
        @if (!empty($variant) && $variant === 'secondary') uc-button--secondary @endif
        @if (!empty($variant) && $variant === 'danger') uc-button--danger @endif
        @if (!empty($full)) w-full @endif"
    @if (!empty($disabled) || !empty($loading)) disabled @endif
    @if (!empty($loadingText)) data-loading-text="{{ $loadingText }}" @endif
>
    @if (!empty($loading))
        <i class="ri-loader-4-line uc-button__spinner" aria-hidden="true"></i>
    @endif

    {{ $slot }}
</button>