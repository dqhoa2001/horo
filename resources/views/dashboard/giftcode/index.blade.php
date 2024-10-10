@extends('layouts.app')
@section('content')
    <h1>Giftcode</h1>

@section('header_table')
    <tr>
        <th>No</th>
        <th>@lang('title.giftcode')</th>
        <th>@lang('title.used_time')</th>
        <th>@lang('title.expiry_time')</th>
        <th colspan="2" class="text-center">@lang('title.action')</th>
    </tr>
@stop
@section('content_table')
    @if (isset($codes) && !empty($codes))
        @foreach ($codes as $index => $item)
            <tr>
                <td>{{ $codes->firstItem() + $index }}</td>
                <td>{{ $item->pin }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->expiry_time }}</td>
                <td class="text-center">
                    <a href="{{ url('dashboard/members/view/' . $item->id) }}">
                        <button type="button" class="btn btn-success">
                            <i class="bi bi-pencil-fill"></i>
                        </button>
                    </a>
                </td>
                <td class="text-center">
                    <a href="#">
                        <button type="button" class="btn btn-danger">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </a>
                </td>
            </tr>
        @endforeach
    @endif
@stop
@include('includes.table')
@include('includes.paginate', ['paginate' => $codes])
@endsection
