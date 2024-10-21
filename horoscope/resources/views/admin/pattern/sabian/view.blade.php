<x-admin.layout>
    @if (empty($sabianPattern))
        <h1>@lang('form.add_sabian_pattern')</h1>
        <x-admin.form action="{{ route('admin.pattern.sabian-create') }}" method='POST'>
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="zodiac_id" class="form-label">惑星</label>
                        <x-admin.dropdown name="zodiac_id" :options="$zodiacs"
                            selectValue="{{ old('zodiac_id', session('zodiac_id')) ?? '' }}" />
                        <x-admin.error-message name='zodiac_id' />
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <x-admin.label :label="__('form.sabian_degrees')" name='sabian_degrees' />
                        <x-admin.sabian-dropdown name='sabian_degrees'
                            selectValue="{{ old('sabian_degrees', session('sabian_degrees')) ?? '' }}">
                        </x-admin.sabian-dropdown>
                        <x-admin.error-message name='sabian_degrees' />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <x-admin.label :label="__('form.title')" name='title' />
                        <x-admin.text-area name='title' value="{{ old('title', session('title')) }}" />
                        <x-admin.error-message name='title' />
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <x-admin.label :label="__('form.title_en')" name='title_en' />
                        <x-admin.text-area name='title_en' value="{{ old('title_en', session('title_en')) }}" />
                        <x-admin.error-message name='title_en' />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <label for="content" class="form-label">@lang('form.content_pattern')（最大：465文字）</label>
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

                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <x-admin.label :label="__('form.title_solar')" name='title_solar' />
                                <x-admin.text-area name='title_solar' value="{{ old('title_solar', session('title_solar')) }}" />
                                <x-admin.error-message name='title_solar' />
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <x-admin.label :label="__('form.title_solar_en')" name='title_solar_en' />
                                <x-admin.text-area name='title_solar_en' value="{{ old('title_solar_en', session('title_solar_en')) }}" />
                                <x-admin.error-message name='title_solar_en' />
                            </div>
                        </div>
                    </div>

                    <label for="content" class="form-label">@lang('form.content_solar_pattern')（最大：465文字）</label>
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
                        <a href="{{ route('admin.pattern.sabian-list') }}" class="btn btn-outline-dark ml-2">一覧へ戻る</a>
                    </div>
                    <x-admin.button type='submit' :text="__('form.create')" />
                </div>
            </div>
        </x-admin.form>
    @else
        <h1>@lang('form.update_sabian_pattern')</h1>
        <x-admin.form action="{{ route('admin.pattern.sabian-update', $sabianPattern->id) }}" method='POST'>
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <x-admin.label :label="__('form.zodiac_name')" name='zodiac_id' />
                        @if (!empty(old()) && array_key_exists('zodiac_id', old()))
                            <x-admin.dropdown name="zodiac_id" :options="$zodiacs"
                                selectValue="{{ old('zodiac_id', session('zodiac_id')) }}" />
                        @else
                            <x-admin.dropdown name="zodiac_id" :options="$zodiacs"
                                selectValue="{{ $sabianPattern->zodiac_id }}" />
                        @endif
                        <x-admin.error-message name='zodiac_id' />
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <x-admin.label :label="__('form.sabian_degrees')" name='sabian_degrees' />
                        @if (!empty(old()) && array_key_exists('zodiac_id', old()))
                            <x-admin.sabian-dropdown name='sabian_degrees'
                                selectValue="{{ old('sabian_degrees', session('sabian_degrees')) ?? '' }}">
                            </x-admin.sabian-dropdown>
                        @else
                            <x-admin.sabian-dropdown name='sabian_degrees'
                                selectValue="{{ $sabianPattern->sabian_degrees }}"></x-admin.sabian-dropdown>
                        @endif
                        <x-admin.error-message name='sabian_degrees' />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <x-admin.label :label="__('form.title')" name='title' />
                        @if (!empty(old()) && array_key_exists('title', old()))
                            <x-admin.text-area name='title' :value="old('title', session('title'))" />
                        @else
                            <x-admin.text-area name='title' :value="$sabianPattern->title" />
                        @endif
                        <x-admin.error-message name='title' />
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <x-admin.label :label="__('form.title_en')" name='title_en' />
                        @if (!empty(old()) && array_key_exists('title_en', old()))
                            <x-admin.text-area name='title_en' :value="old('title_en', session('title_en'))" />
                        @else
                            <x-admin.text-area name='title_en' :value="$sabianPattern->title_en" />
                        @endif
                        <x-admin.error-message name='title_en' />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <label for="content" class="form-label">@lang('form.content_pattern')（最大：465文字）</label>
                    <div class="col-md-12 col-12">
                        <div class="form-floating mb-3">
                            @if (!empty(old()) && array_key_exists('content', old()))
                                <x-admin.text-area name='content' :value="old('content', session('content'))" />
                            @else
                                <x-admin.text-area name='content' :value="$sabianPattern->content" />
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
                                <x-admin.text-area name='content_en' :value="$sabianPattern->content_en" />
                            @endif
                            <x-admin.label :label="__('form.content_english')" name='content_en' />
                            <x-admin.error-message name='content_en' />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <x-admin.label :label="__('form.title_solar')" name='title_solar' />
                                @if (!empty(old()) && array_key_exists('title_solar', old()))
                                    <x-admin.text-area name='title_solar' :value="old('title_solar', session('title_solar'))" />
                                @else
                                    <x-admin.text-area name='title_solar' :value="$sabianPattern->title_solar" />
                                @endif
                                <x-admin.error-message name='title_solar' />
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <x-admin.label :label="__('form.title_solar_en')" name='title_solar_en' />
                                @if (!empty(old()) && array_key_exists('title_solar_en', old()))
                                    <x-admin.text-area name='title_solar_en' :value="old('title_en', session('title_solar_en'))" />
                                @else
                                    <x-admin.text-area name='title_solar_en' :value="$sabianPattern->title_solar_en" />
                                @endif
                                <x-admin.error-message name='title_solar_en' />
                            </div>
                        </div>
                    </div>

                    <label for="content" class="form-label">@lang('form.content_solar_pattern')（最大：465文字）</label>
                    <div class="col-md-12 col-12">
                        <div class="form-floating mb-3">
                            @if (!empty(old()) && array_key_exists('content_solar', old()))
                                <x-admin.text-area name='content_solar' :value="old('content_solar', session('content_solar'))" />
                            @else
                                <x-admin.text-area name='content_solar' :value="$sabianPattern->content_solar" />
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
                                <x-admin.text-area name='content_solar_en' :value="$sabianPattern->content_solar_en" />
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
                        <a href="{{ route('admin.pattern.sabian-list') }}" class="btn btn-outline-dark ml-2">一覧へ戻る</a>
                    </div>
                    <x-admin.button type='submit' :text="__('保存')" />
                </div>
            </div>
        </x-admin.form>
    @endif
</x-admin.layout>
