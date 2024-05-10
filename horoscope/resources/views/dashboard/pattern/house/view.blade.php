<x-layout>
    @if (empty($housePattern))
        <h1>@lang('form.add_house_pattern')</h1>
        <x-form action="{{ route('dashboard.pattern.house-create') }}" method='POST'>
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <x-label :label="__('form.house_name')" name='house_id' />
                        <x-dropdown name="house_id" :options="$houses"
                            selectValue="{{ old('house_id', session('house_id')) ?? '' }}" />
                        <x-error-message name='house_id' />
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
        <h1>@lang('form.update_house_pattern')</h1>
        <x-form action="{{ route('dashboard.pattern.house-update', $housePattern->id) }}" method='POST'>
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <x-label :label="__('form.house_name')" name='house_id' />
                        @if (!empty(old()) && array_key_exists('house_id', old()))
                            <x-dropdown name="house_id" :options="$houses"
                                selectValue="{{ old('house_id', session('house_id')) }}" />
                        @else
                            <x-dropdown name="house_id" :options="$houses"
                                selectValue="{{ $housePattern->house_id }}" />
                        @endif
                        <x-error-message name='house_id' />
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <x-label :label="__('form.planet_name')" name='planet_id' />
                        @if (!empty(old()) && array_key_exists('house_id', old()))
                            <x-dropdown name="planet_id" :options="$planets"
                                selectValue="{{ old('planet_id', session('planet_id')) }}" />
                        @else
                            <x-dropdown name="planet_id" :options="$planets"
                                selectValue="{{ $housePattern->planet_id }}" />
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
                                <x-text-area name='content' :value="$housePattern->content" />
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
                                <x-text-area name='content_en' :value="$housePattern->content_en" />
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
