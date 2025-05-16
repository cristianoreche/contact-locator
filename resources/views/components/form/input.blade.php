<div class="uc-form__group">
    @if($label)
        <label for="{{ $name }}" class="uc-form__label">
            {{ $label }} @if($required)<span class="uc-form__required">*</span>@endif
        </label>
    @endif

    <div class="uc-form__input-wrapper">
        <input
            type="{{ $type }}"
            name="{{ $name }}"
            id="{{ $name }}"
            placeholder="{{ $placeholder }}"
            value="{{ old($name, $attributes->get('value')) }}"
            @if($required) required @endif
            {{ $attributes->merge(['class' => 'uc-form__input']) }}
        >

        @if($type === 'password')
            <button type="button" class="uc-form__toggle-password" onclick="togglePassword('{{ $name }}')" style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); background: transparent; border: none; cursor: pointer;">
                <i class="ri-eye-line" id="icon-{{ $name }}"></i>
            </button>
        @endif
    </div>

    @error($name)
        <div class="uc-form__error">{{ $message }}</div>
    @enderror
</div>
