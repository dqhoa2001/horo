<x-layout>
    @if (empty($sabianPattern))
        <h1>@lang('form.add_sabian_pattern')</h1>
        <x-form action="{{ route('dashboard.pattern.sabian-create') }}" method='POST'>
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <x-label :label="__('form.zodiac_name')" name='zodiac_id' />
                        <x-dropdown name="zodiac_id" :options="$zodiacs"
                            selectValue="{{ old('zodiac_id', session('zodiac_id')) ?? '' }}" />
                        <x-error-message name='zodiac_id' />
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <x-label :label="__('form.sabian_degrees')" name='sabian_degrees' />
                        <x-sabian-dropdown name='sabian_degrees'
                            selectValue="{{ old('sabian_degrees', session('sabian_degrees')) ?? '' }}">
                        </x-sabian-dropdown>
                        <x-error-message name='sabian_degrees' />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <x-label :label="__('form.title')" name='title' />
                        <x-text-area name='title' value="{{ old('title', session('title')) }}" />
                        <x-error-message name='title' />
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <x-label :label="__('form.title_en')" name='title_en' />
                        <x-text-area name='title_en' value="{{ old('title_en', session('title_en')) }}" />
                        <x-error-message name='title_en' />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <label for="content" class="form-label">@lang('form.content_pattern')</label>
                    <div class="col-md-12 col-12">
                        <div class="form-floating mb-3">
                            <x-text-area name='content' :value="old('content', session('content')) ?? ''" />
                            <x-label :label="__('form.content_japanese')" name='content' />
                            <x-error-message name='content' />
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-floating mb-3">
                            <x-text-area name='content_en' :value="old('content_en', session('content_en')) ?? ''" />
                            <x-label :label="__('form.content_english')" name='content_en' />
                            <x-error-message name='content_en' />
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 d-flex justify-content-end">
                    <x-button type='submit' :text="__('form.create')" />
                </div>
            </div>
        </x-form>
    @else
        <h1>@lang('form.update_sabian_pattern')</h1>
        <x-form action="{{ route('dashboard.pattern.sabian-update', $sabianPattern->id) }}" method='POST'>
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <x-label :label="__('form.zodiac_name')" name='zodiac_id' />
                        @if (!empty(old()) && array_key_exists('zodiac_id', old()))
                            <x-dropdown name="zodiac_id" :options="$zodiacs"
                                selectValue="{{ old('zodiac_id', session('zodiac_id')) }}" />
                        @else
                            <x-dropdown name="zodiac_id" :options="$zodiacs"
                                selectValue="{{ $sabianPattern->zodiac_id }}" />
                        @endif
                        <x-error-message name='zodiac_id' />
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <x-label :label="__('form.sabian_degrees')" name='sabian_degrees' />
                        @if (!empty(old()) && array_key_exists('zodiac_id', old()))
                            <x-sabian-dropdown name='sabian_degrees'
                                selectValue="{{ old('sabian_degrees', session('sabian_degrees')) ?? '' }}">
                            </x-sabian-dropdown>
                        @else
                            <x-sabian-dropdown name='sabian_degrees'
                                selectValue="{{ $sabianPattern->sabian_degrees }}"></x-sabian-dropdown>
                        @endif
                        <x-error-message name='sabian_degrees' />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <x-label :label="__('form.title')" name='title' />
                        @if (!empty(old()) && array_key_exists('title', old()))
                            <x-text-area name='title' :value="old('title', session('title'))" />
                        @else
                            <x-text-area name='title' :value="$sabianPattern->title" />
                        @endif
                        <x-error-message name='title' />
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <x-label :label="__('form.title_en')" name='title_en' />
                        @if (!empty(old()) && array_key_exists('title_en', old()))
                            <x-text-area name='title_en' :value="old('title_en', session('title_en'))" />
                        @else
                            <x-text-area name='title_en' :value="$sabianPattern->title_en" />
                        @endif
                        <x-error-message name='title_en' />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <label for="content" class="form-label">@lang('form.content_pattern')</label>
                    <div class="col-md-12 col-12">
                        <div class="form-floating mb-3">
                            @if (!empty(old()) && array_key_exists('content', old()))
                                <x-text-area name='content' :value="old('content', session('content'))" />
                            @else
                                <x-text-area name='content' :value="$sabianPattern->content" />
                            @endif
                            <x-label :label="__('form.content_japanese')" name='content' />
                            <x-error-message name='content' />
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-floating mb-3">
                            @if (!empty(old()) && array_key_exists('content_en', old()))
                                <x-text-area name='content_en' :value="old('content_en', session('content_en'))" />
                            @else
                                <x-text-area name='content_en' :value="$sabianPattern->content_en" />
                            @endif
                            <x-label :label="__('form.content_english')" name='content_en' />
                            <x-error-message name='content_en' />
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 d-flex justify-content-end">
                    <x-button type='submit' :text="__('保存')" />
                </div>
            </div>
        </x-form>
    @endif
</x-layout>
