{{-- これはold関数の無いバージョンのパスワードフォームです --}}

<input type="password"
    name="{{ $name }}"
    id="{{ $name }}"
    class="form-control
            @error($name) is-invalid @enderror
            @isset($class) {{ $class }} @endisset
        "
    @isset ($required)
        @if ($required === true)
            required
        @endif
    @endisset
    @isset($placeholder)
        placeholder="{{ $placeholder }}"
    @endif
>