<x-admin.layout>
    @if (empty($housePattern))
        <h1>@lang('form.add_house_pattern')</h1>
        <x-admin.form action="{{ route('admin.pattern.house-create') }}" method='POST'>
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <x-admin.label :label="__('form.planet_name')" name='planet_id' />
                        <x-admin.dropdown name="planet_id" :options="$planets"
                            selectValue="{{ old('planet_id', session('planet_id')) ?? '' }}" />
                        <x-admin.error-message name='planet_id' />
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <x-admin.label :label="__('form.house_name')" name='house_id' />
                        <x-admin.dropdown name="house_id" :options="$houses"
                            selectValue="{{ old('house_id', session('house_id')) ?? '' }}" />
                        <x-admin.error-message name='house_id' />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="content" class="form-label">@lang('form.content_pattern')（最大：410文字）</label>
                    <div class="col-md-12 col-12">
                        <div class="form-floating mb-3">
                            <x-admin.text-area name='content' :value="old('content', session('content')) ?? ''" />
                            <x-admin.label :label="__('form.content_japanese')" name='content' />
                            <x-admin.error-message name='content' />
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-floating mb-3">
                            <x-admin.text-area name='content_en' :value="old('content_en', session('content_en')) ?? ''" />
                            <x-admin.label :label="__('form.content_english')" name='content_en' />
                            <x-admin.error-message name='content_en' />
                        </div>
                    </div>
                    <label for="content" class="form-label">@lang('form.content_solar_pattern')（最大：410文字）</label>
                    <div class="col-md-12 col-12">
                        <div class="form-floating mb-3">
                            <x-admin.text-area name='content_solar' :value="old('content_solar', session('content_solar')) ?? ''" />
                            <x-admin.label :label="__('form.content_japanese')" name='content_solar' />
                            <x-admin.error-message name='content_solar' />
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-floating mb-3">
                            <x-admin.text-area name='content_solar_en' :value="old('content_solar_en', session('content_solar_en')) ?? ''" />
                            <x-admin.label :label="__('form.content_english')" name='content_solar_en' />
                            <x-admin.error-message name='content_solar_en' />
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 d-flex justify-content-end">
                    <div class="me-3">
                        <a href="{{ route('admin.pattern.house-list') }}" class="btn btn-outline-dark ml-2">一覧へ戻る</a>
                    </div>
                    <x-admin.button type='submit' :text="__('form.create')" />
                </div>
            </div>
        </x-admin.form>
    @else
        <h1>@lang('form.update_house_pattern')</h1>
        <x-admin.form action="{{ route('admin.pattern.house-update', $housePattern->id) }}" method='POST'>
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <x-admin.label :label="__('form.planet_name')" name='planet_id' />
                        @if (!empty(old()) && array_key_exists('house_id', old()))
                            <x-admin.dropdown name="planet_id" :options="$planets"
                                selectValue="{{ old('planet_id', session('planet_id')) }}" />
                        @else
                            <x-admin.dropdown name="planet_id" :options="$planets"
                                selectValue="{{ $housePattern->planet_id }}" />
                        @endif
                        <x-admin.error-message name='planet_id' />
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <x-admin.label :label="__('form.house_name')" name='house_id' />
                        @if (!empty(old()) && array_key_exists('house_id', old()))
                            <x-admin.dropdown name="house_id" :options="$houses"
                                selectValue="{{ old('house_id', session('house_id')) }}" />
                        @else
                            <x-admin.dropdown name="house_id" :options="$houses"
                                selectValue="{{ $housePattern->house_id }}" />
                        @endif
                        <x-admin.error-message name='house_id' />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="content" class="form-label">@lang('form.content_pattern')（最大：410文字）</label>
                    <div class="col-md-12 col-12">
                        <div class="form-floating mb-3">
                            @if (!empty(old()) && array_key_exists('content', old()))
                                <x-admin.text-area name='content' :value="old('content', session('content'))" />
                            @else
                                <x-admin.text-area name='content' :value="$housePattern->content" />
                            @endif
                            <x-admin.label :label="__('form.content_japanese')" name='content' />
                            <x-admin.error-message name='content' />
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-floating mb-3">
                            @if (!empty(old()) && array_key_exists('content_en', old()))
                                <x-admin.text-area name='content_en' :value="old('content_en', session('content_en'))" />
                            @else
                                <x-admin.text-area name='content_en' :value="$housePattern->content_en" />
                            @endif
                            <x-admin.label :label="__('form.content_english')" name='content_en' />
                            <x-admin.error-message name='content_en' />
                        </div>
                    </div>
                    <label for="content" class="form-label">@lang('form.content_solar_pattern')（最大：410文字）</label>
                    <div class="col-md-12 col-12">
                        <div class="form-floating mb-3">
                            @if (!empty(old()) && array_key_exists('content_solar', old()))
                                <x-admin.text-area name='content_solar' :value="old('content_solar', session('content_solar'))" />
                            @else
                                <x-admin.text-area name='content_solar' :value="$housePattern->content_solar" />
                            @endif
                            <x-admin.label :label="__('form.content_japanese')" name='content_solar' />
                            <x-admin.error-message name='content_solar' />
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-floating mb-3">
                            @if (!empty(old()) && array_key_exists('content_solar_en', old()))
                                <x-admin.text-area name='content_solar_en' :value="old('content_solar_en', session('content_solar_en'))" />
                            @else
                                <x-admin.text-area name='content_solar_en' :value="$housePattern->content_solar_en" />
                            @endif
                            <x-admin.label :label="__('form.content_english')" name='content_solar_en' />
                            <x-admin.error-message name='content_solar_en' />
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 d-flex justify-content-end">
                    <div class="me-3">
                        <a href="{{ route('admin.pattern.house-list') }}" class="btn btn-outline-dark ml-2">一覧へ戻る</a>
                    </div>
                    <x-admin.button type='submit' :text="__('保存')" />
                </div>
            </div>
        </x-admin.form>
    @endif
</x-admin.layout>
