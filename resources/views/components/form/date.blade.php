<input type="date" 
   name="{{ $name }}"
    id="{{ $name }}"
    max="9999-12-31"
    class="form-control
            form-control-date
            @error($name) is-invalid @enderror
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
    @isset ($disabled)
        disabled
    @endisset
    @isset ($placeholder)
        placeholder="{{ $placeholder }}"
    @endif
    @isset($refs)
        ref="{{ $refs }}"
    @endisset
>
