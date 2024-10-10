<select class="form-select" name={{ $name }}>
    <option value="" {{ empty($selectValue) ? 'selected' : '' }}>
        @lang('form.please_select')
    </option>
    @for ($i = 1; $i <= 30; $i++)
        <option value={{ $i }} {{ !empty($selectValue) && $selectValue == $i ? 'selected' : '' }}>
            {{ $i }} @lang('form.degrees')
        </option>
    @endfor
</select>
