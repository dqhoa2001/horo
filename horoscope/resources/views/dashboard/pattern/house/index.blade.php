<x-layout>
    <h1>@lang('table.house_pattern_list')</h1>
    <div class="card">
        <div class="card-body">
    <x-toast />
    <x-table>
        <x-slot name='header'>
            <tr>
                <th class="text-center"style="width: 5%">No</th>
                <th class="text-center" style="width: 8%">@lang('table.house_name')</th>
                <th class="text-center" style="width: 8%">@lang('table.planet_name')</th>
                <th class="text-center">@lang('table.content')</th>
                <th class="text-center">@lang('table.content_en')</th>
                <th  class="text-center">@lang('table.action')</th>
            </tr>
        </x-slot>
        <x-slot name='body'>
            @if (isset($housePatterns) && !empty($housePatterns))
                @foreach ($housePatterns as $index => $pattern)
                    <tr>
                        <td class="text-center">{{ $pattern->id}}</td>
                        @if (!session()->has('lang_code') || session('lang_code') == 'ja')
                            <td class="text-center"> {{ $pattern->house->name }}</td>
                            <td class="text-center">{{ $pattern->planet->name }}</td>
                        @else
                            <td class="text-center">{{ $pattern->house->name_en }}</td>
                            <td class="text-center"> {{ $pattern->planet->name_en }}</td>
                        @endif
                        <td class="text-left text-truncate" style="max-width: 320px">{{ $pattern->content }}</td>
                        <td class="text-left text-truncate" style="max-width: 320px">{{ $pattern->content_en }}</td>
                        <td class="text-center">
                            <div class="btn-group">
                            <a href={{ route('dashboard.pattern.house-view', $pattern->id) }}>
                                <button type="button" class="btn btn-success mx-1">
                                    <i class="bi bi-pencil-fill"></i>
                                </button>
                            </a>
                            <button type="button" class="btn btn-danger mx-1" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $id = $pattern->id }}"
                                data-action={{ $action = route('dashboard.pattern.house-delete', $pattern->id) }}>
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
            @include('includes.paginate', ['paginate' => $housePatterns])
        </x-slot> --}}
    </x-table>
</div>
</div>
</x-layout>
