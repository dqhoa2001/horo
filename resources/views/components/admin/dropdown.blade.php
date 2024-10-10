{{-- @dd($options) --}}
<select class="form-select" name={{ $name }}>
    <option value="" {{ empty($selectValue) ? 'selected' : '' }}>
        @lang('form.please_select')
    </option>
    @if (!empty($options))
        @foreach ($options as $key => $value)
            <option value={{ $value->id }}
                {{ !empty($selectValue) && $selectValue == $value->id ? 'selected' : '' }}>
                @if (!session()->has('lang_code') || session('lang_code') == 'ja')
                    {{ $value->name }}
                @else
                    {{ $value->name_en }}
                @endif
            </option>
        @endforeach
    @endif
</select>
