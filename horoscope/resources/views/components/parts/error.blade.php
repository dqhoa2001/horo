@if ($errors->any())
    @php
        $data = array_unique($errors->all());
    @endphp
    @foreach ($data as $message)
        <p style="color: red" >{{ $message }}</p>
    @endforeach
@endif
