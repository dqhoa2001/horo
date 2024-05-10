<input type="text" name="{{ $name }}" id="{{ $name }}" class="form-control @error($name) is-invalid @enderror"
  value="{{ old($name, $value) }}" {{ $required ? 'required' : '' }}>