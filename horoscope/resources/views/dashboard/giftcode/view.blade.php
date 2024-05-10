@extends('layouts.app')
@section('content')
    @if (empty(request()->id))
        <h1>@lang('title.add_new_giftcode')</h1>
    @else
        <h1>@lang('title.edit_giftcode')</h1>
    @endif
    @include('forms.addGiftcode')
@endsection
