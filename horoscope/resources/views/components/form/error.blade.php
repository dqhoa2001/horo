{{--@include('components.form.error', ['name' => ''])--}}

@error($name)
    <span class="invalid-feedback text-danger @isset($class) {{ $class }} @endisset" role="alert" style="text-align: left; display:block;">
        <strong>{{ $message }}</strong>
    </span>
@enderror