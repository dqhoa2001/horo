{{-- 例 @include('components.form.text', ['name' => 'ネーム属性', 'required' => true, 'class' => '追加したいクラス名']) --}}

<input type="text"
    name="{{ $name }}"
    id="{{ $name }}"
    class="form-control
            @isset($errName)
                @error($errName) is-invalid @enderror
            @else
                @error($name) is-invalid @enderror
            @endisset
            @isset($class) {{ $class }} @endisset
        "
    @isset ($value)
        value="{{ old($name, $value) }}"
    @else
        value="{{ old($name) }}"
    @endisset
    @isset ($required)
        @if ($required === true)
            required
        @endif
    @endisset
    @isset ($placeholder)
        placeholder="{{ $placeholder }}"
    @endif
    @isset ($vModel)
        v-model="{{ $vModel }}"
    @endif
    @isset ($disabled)
        disabled
    @endisset
    @isset($onKeyUp)
        onKeyUp="{{ $onKeyUp }}"
    @endisset
    @isset($refs)
        ref="{{ $refs }}"
    @endisset
    @isset($validateText)
        oninput="{{ $validateText }}"
    @endisset
    @isset($vInput)
        @input="{{ $vInput }}"
    @endisset
    @isset($autocomplete)
        autocomplete="{{ $autocomplete }}"
    @endisset
    @isset($hyphenCheck)
        oninput="this.value = this.value.replace(/-/g, '')"
    @endisset

>
