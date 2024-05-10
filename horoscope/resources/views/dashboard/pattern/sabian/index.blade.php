<x-layout>
    <h1>@lang('table.sabian_pattern_list')</h1>
    <div class="card">
        <div class="card-body">
    <x-toast />
    <x-table>
        <x-slot name='header'>
            <tr>
                <th class="text-center" style="width: 5%">No</th>
                <th class="text-center" style="width: 8%">@lang('table.zodiac_name')</th>
                <th class="text-center" style="width: 5%">@lang('table.degrees')</th>
                <th class="text-center" style="width: 8%">@lang('table.title')</th>
                <th class="text-center" style="width: 8%">@lang('table.title_en')</th>
                <th class="text-center">@lang('table.content')</th>
                <th class="text-center">@lang('table.content_en')</th>
                {{-- <th>@lang('title.published')</th> --}}
                <th  class="text-center">@lang('table.action')</th>
            </tr>
        </x-slot>
        <x-slot name='body'>
            @if (isset($sabianPatterns) && !empty($sabianPatterns))
                @foreach ($sabianPatterns as $index => $pattern)
                    <tr>
                        <td class="text-center">{{ $pattern->id }}</td>
                        @if (!session()->has('lang_code') || session('lang_code') == 'ja')
                            <td class="text-center">{{ $pattern->zodiac->name }}</td>
                            <td class="text-center">{{ $pattern->sabian_degrees }}</td>
                        @else
                            <td class="text-center">{{ $pattern->zodiac->name_en }}</td>
                            <td class="text-center">{{ $pattern->sabian_degrees }}</td>
                        @endif
                        <td class="text-left text-truncate" style="max-width: 150px">{{ $pattern->title }}</td>
                        <td class="text-left text-truncate" style="max-width: 150px">{{ $pattern->title_en }}</td>
                        <td class="text-left text-truncate" style="max-width: 220px">{{ $pattern->content }}</td>
                        <td class="text-left text-truncate" style="max-width: 220px">{{ $pattern->content_en }}</td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{ route('dashboard.pattern.sabian-view', $pattern->id) }}">
                                    <button type="button" class="btn btn-success mx-1">
                                        <i class="bi bi-pencil-fill"></i>
                                    </button>
                                </a>
                                <button type="button" class="btn btn-danger mx-1" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $id = $pattern->id }}"
                                    data-action="{{ $action = route('dashboard.pattern.sabian-delete', $pattern->id) }}">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>
                        </td>                                                
                    </tr>
                    @include('includes.modal')
                @endforeach
            @endif
        </x-slot>
        {{-- <x-slot name='paginate'>
            @include('includes.paginate', ['paginate' => $sabianPatterns])
        </x-slot> --}}
    </x-table>
</div>
</div>
</x-layout>
