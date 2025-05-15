<div class="uc-form__group">
    @if($label)
        <label for="{{ $name }}" class="uc-form__label">
            {{ $label }} @if($required)<span class="uc-form__required">*</span>@endif
        </label>
    @endif

    <select
        name="{{ $name }}"
        id="{{ $name }}"
        {{ $attributes->merge(['class' => 'uc-form__select']) }}
        @if($required) required @endif
    >
        <option value="">{{ $placeholder }}</option>
        @foreach($options as $value => $text)
            <option value="{{ $value }}" {{ old($name) == $value ? 'selected' : '' }}>
                {{ $text }}
            </option>
        @endforeach
    </select>

    @error($name)
        <div class="uc-form__error">{{ $message }}</div>
    @enderror
</div>
