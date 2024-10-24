<x-layout>
    @if (empty($aspectPattern))
        <h1>@lang('form.add_aspect_pattern')</h1>
        <x-form action="{{ route('dashboard.pattern.aspect-create') }}" method='POST'>
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <x-label :label="__('form.aspect_name')" name='aspect_id' />
                        <x-dropdown name="aspect_id" :options="$aspects"
                            selectValue="{{ old('aspect_id', session('aspect_id')) ?? '' }}" />
                        <x-error-message name='aspect_id' />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <x-label :label="__('form.from_planet_name')" name='from_planet_id' />
                        <x-dropdown name="from_planet_id" :options="$planets"
                            selectValue="{{ old('from_planet_id', session('from_planet_id')) ?? '' }}" />
                        <x-error-message name='from_planet_id' />
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <x-label :label="__('form.to_planet_name')" name='to_planet_id' />
                        <x-dropdown name="to_planet_id" :options="$planets"
                            selectValue="{{ old('to_planet_id', session('to_planet_id')) ?? '' }}" />
                        <x-error-message name='to_planet_id' />
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
        <x-form action="{{ route('dashboard.pattern.aspect-update', $aspectPattern->id) }}" method='POST'>
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <x-label :label="__('form.aspect_name')" name='aspect_id' />
                        @if (!empty(old()) && array_key_exists('aspect_id', old()))
                            <x-dropdown name="aspect_id" :options="$aspects"
                                selectValue="{{ old('aspect_id', session('aspect_id')) }}" />
                        @else
                            <x-dropdown name="aspect_id" :options="$aspects"
                                selectValue="{{ $aspectPattern->aspect_id }}" />
                        @endif
                        <x-error-message name='aspect_id' />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <x-label :label="__('form.from_planet_name')" name='from_planet_id' />
                        @if (!empty(old()) && array_key_exists('from_planet_id', old()))
                            <x-dropdown name="from_planet_id" :options="$planets"
                                selectValue="{{ old('from_planet_id', session('from_planet_id')) }}" />
                        @else
                            <x-dropdown name="from_planet_id" :options="$planets"
                                selectValue="{{ $aspectPattern->from_planet_id }}" />
                        @endif
                        <x-error-message name='from_planet_id' />
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <x-label :label="__('form.to_planet_name')" name='to_planet_id' />
                        @if (!empty(old()) && array_key_exists('house_id', old()))
                            <x-dropdown name="to_planet_id" :options="$planets"
                                selectValue="{{ old('to_planet_id', session('to_planet_id')) }}" />
                        @else
                            <x-dropdown name="to_planet_id" :options="$planets"
                                selectValue="{{ $aspectPattern->to_planet_id }}" />
                        @endif
                        <x-error-message name='to_planet_id' />
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
                                <x-text-area name='content' :value="$aspectPattern->content" />
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
                                <x-text-area name='content_en' :value="$aspectPattern->content_en" />
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
