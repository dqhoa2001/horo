{{--@include('components.form.time', ['name' => '', 'required' => false])--}}

<input type="time"
    name="{{ $name }}"
    id="{{ $name }}"
    class="form-control @error($name) is-invalid @enderror"
    @isset ($value)
        value="{{ old($name, $value) }}"
    @else
        value="{{ old($name) }}"
    @endisset
    {{ $required ? 'required' : '' }}
    @isset ($disabled)
        disabled
    @endisset
    @isset ($inputmode)
        inputmode="{{ $inputmode }}"
    @endisset
    @isset($refs)
        ref="{{ $refs }}"
    @endisset

>
