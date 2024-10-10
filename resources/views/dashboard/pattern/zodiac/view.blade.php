<x-layout>
    @if (empty($zodiacPattern))
        <h1>@lang('form.add_zodiac_pattern')</h1>
        <x-form action="{{ route('dashboard.pattern.zodiac-create') }}" method='POST'>
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
                        <x-label :label="__('form.planet_name')" name='planet_id' />
                        <x-dropdown name="planet_id" :options="$planets"
                            selectValue="{{ old('planet_id', session('planet_id')) ?? '' }}" />
                        <x-error-message name='planet_id' />
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
        <h1>@lang('form.update_zodiac_pattern')</h1>
        <x-form action="{{ route('dashboard.pattern.zodiac-update', $zodiacPattern->id) }}" method='POST'>
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <x-label :label="__('form.zodiac_name')" name='zodiac_id' />
                        @if (!empty(old()) && array_key_exists('zodiac_id', old()))
                            <x-dropdown name="zodiac_id" :options="$zodiacs"
                                selectValue="{{ old('zodiac_id', session('zodiac_id')) }}" />
                        @else
                            <x-dropdown name="zodiac_id" :options="$zodiacs"
                                selectValue="{{ $zodiacPattern->zodiac_id }}" />
                        @endif
                        <x-error-message name='zodiac_id' />
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <x-label :label="__('form.planet_name')" name='planet_id' />
                        @if (!empty(old()) && array_key_exists('planet_id', old()))
                            <x-dropdown name="planet_id" :options="$planets"
                                selectValue="{{ old('planet_id', session('planet_id')) }}" />
                        @else
                            <x-dropdown name="planet_id" :options="$planets"
                                selectValue="{{ $zodiacPattern->planet_id }}" />
                        @endif
                        <x-error-message name='planet_id' />
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
                                <x-text-area name='content' :value="$zodiacPattern->content" />
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
                                <x-text-area name='content_en' :value="$zodiacPattern->content_en" />
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
