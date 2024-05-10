<x-layout>
    @if (empty($member))
        <h1>@lang('form.add_member')</h1>
        <x-form action="{{ route('dashboard.member-create') }}" method="POST">
            <div class="row">
                <div class="col-md-12 col-12">
                    <div class="form-group">
                        <x-label :label="__('form.name')" name='name' />
                        <x-input type='text' name='name' value="{{ old('name', session('name')) }}" />
                        <x-error-message name='name' />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-12">
                    <div class="form-group">
                        <x-label :label="__('form.email')" name='email' />
                        <x-input type='text' name='email' value="{{ old('email', session('email')) }}" />
                        <x-error-message name='email' />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <x-label :label="__('form.phone')" name='phone' />
                        <x-input type='text' name='phone' value="{{ old('phone', session('phone')) }}" />
                        <x-error-message name='phone' />
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <x-label :label="__('form.day_of_birth')" name='day_of_birth' />
                        <x-input type='date' name='day_of_birth'
                            value="{{ old('day_of_birth', session('day_of_birth')) }}" />
                        <x-error-message name='day_of_birth' />
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
        <h1>@lang('form.update_member')</h1>
        <x-form action="{{ route('dashboard.member-update', $member->id) }}" method="POST">
            <div class="row">
                <div class="col-md-12 col-12">
                    <div class="form-group">
                        <x-label :label="__('form.name')" name='name' />
                        @if (!empty(old()) && array_key_exists('name', old()))
                            <x-input type='text' name='name' value="{{ old('name', session('name')) }}" />
                        @else
                            <x-input type='text' name='name' :value="$member->name" />
                        @endif
                        <x-error-message name='name' />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-12">
                    <div class="form-group">
                        <x-label :label="__('form.email')" name='email' />
                        @if (!empty(old()) && array_key_exists('email', old()))
                            <x-input type='text' name='email' value="{{ old('email', session('email')) }}" />
                        @else
                            <x-input type='text' name='email' :value="$member->email" />
                        @endif
                        <x-error-message name='email' />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <x-label :label="__('form.phone')" name='phone' />
                        @if (!empty(old()) && array_key_exists('phone', old()))
                            <x-input type='text' name='phone' value="{{ old('phone', session('phone')) }}" />
                        @else
                            <x-input type='text' name='phone' :value="$member->phone" />
                        @endif
                        <x-error-message name='phone' />
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <x-label :label="__('form.day_of_birth')" name='day_of_birth' />
                        @if (!empty(old()) && array_key_exists('day_of_birth', old()))
                            <x-input type='date' name='day_of_birth'
                                value="{{ old('day_of_birth', session('day_of_birth')) }}" />
                        @else
                            <x-input type='date' name='day_of_birth' value="{{ $member->day_of_birth }}" />
                        @endif
                        <x-error-message name='day_of_birth' />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 d-flex justify-content-end">
                    <x-button type='submit' :text="__('form.update')" />
                </div>
            </div>
        </x-form>
    @endif
</x-layout>
