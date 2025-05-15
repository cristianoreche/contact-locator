<div class="uc-form__group">
    @if($label)
        <label for="{{ $name }}" class="uc-form__label">
            {{ $label }} @if($required)<span class="uc-form__required">*</span>@endif
        </label>
    @endif

    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        placeholder="{{ $placeholder }}"
        value="{{ old($name) }}"
        @if($required) required @endif
        {{ $attributes->merge(['class' => 'uc-form__input']) }}
    >

    @error($name)
        <div class="uc-form__error">{{ $message }}</div>
    @enderror
</div>
