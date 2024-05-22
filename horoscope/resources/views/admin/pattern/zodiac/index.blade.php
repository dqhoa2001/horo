<x-admin.layout>
    <div class="d-flex justify-content-between align-items-center">
        <h1>@lang('table.zodiac_pattern_list')</h1>
        <a href="{{ route('admin.pattern.zodiac-view') }}" class="btn btn-primary">作成する</a>
    </div>
    <div class="card">
        <div class="card-body">
            <x-admin.toast />
            <form action="{{ route('admin.pattern.zodiac-list') }}" method="GET" class="mb-3">
                <div class="row">
                    <div class="col">
                        <select name="planet_id" class="form-select">
                            <option value="">天体</option>
                            @foreach($planets as $planet)
                            <option value="{{ $planet->id }}" {{ $selectedValues['planet_id'] == $planet->id ? 'selected' : '' }}>
                                {{ $planet->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <select name="zodiac_id" class="form-select">
                            <option value="">星座</option>
                            @foreach($zodiacs as $zodiac)
                            <option value="{{ $zodiac->id }}" {{ $selectedValues['zodiac_id'] == $zodiac->id ? 'selected' : '' }}>
                                {{ $zodiac->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <input type="text" name="keyword" class="form-control" placeholder="内容。。。" value="{{ $selectedValues['keyword'] }}">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">検索</button>
                    </div>
                    <div class="col-auto">
                        <a class="btn btn-success" href="{{ route('admin.pattern.zodiac-list') }}">リセット</a>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <x-admin.table>
                    <x-slot name='header'>
                        <tr>
                            <th class="text-center" style="width: 5%">No</th>
                            <th class="text-center" style="width: 8%">@lang('table.planet_name')</th>
                            <th class="text-center" style="width: 8%">@lang('table.zodiac_name')</th>
                            <th class="text-center">@lang('table.content')</th>
                            <th class="text-center">@lang('table.content_en')</th>
                            <th class="text-center">@lang('table.content_solar')</th>
                            <th class="text-center">@lang('table.content_solar_en')</th>
                            {{-- <th>@lang('title.published')</th> --}}
                            <th class="text-center">@lang('table.action')</th>
                        </tr>
                    </x-slot>
                    <x-slot name='body'>
                        @if (isset($zodiacPatterns) && !empty($zodiacPatterns))
                            @foreach ($zodiacPatterns as $index => $pattern)
                                <tr>
                                    <td class="text-center">{{ $pattern->id }}</td>
                                    @if (!session()->has('lang_code') || session('lang_code') == 'ja')
                                        <td class="text-center">{{ $pattern->planet->name }}</td>
                                        <td class="text-center">{{ $pattern->zodiac->name }}</td>
                                    @else
                                        <td class="text-center">{{ $pattern->planet->name_en }}</td>
                                        <td class="text-center">{{ $pattern->zodiac->name_en }}</td>
                                    @endif
                                    <td class="text-left text-truncate" style="max-width: 320px">{!! nl2br(e($pattern->content)) !!}</td>
                                    <td class="text-left text-truncate" style="max-width: 320px">{!! nl2br(e($pattern->content_en)) !!}</td>
                                    <td class="text-left text-truncate" style="max-width: 320px">{!! nl2br(e($pattern->content_solar)) !!}</td>
                                    <td class="text-left text-truncate" style="max-width: 320px">{!! nl2br(e($pattern->content_solar_en)) !!}</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href={{ route('admin.pattern.zodiac-view', $pattern->id) }}>
                                                <button type="button" class="btn btn-success mx-1">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </button>
                                            </a>
                                            <button type="button" class="btn btn-danger mx-1" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $id = $pattern->id }}"
                                                data-action={{ $action = route('admin.pattern.zodiac-delete', $pattern->id) }}>
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                        </div>
                                    </td>

                                </tr>
                                @include('Includes.admin.modal')
                            @endforeach
                        @endif
                    </x-slot>
                    <x-slot name='paginate'>
                        @include('Includes.admin.paginate', ['paginate' => $zodiacPatterns])
                    </x-slot>
                </x-admin.table>
            </div>
        </div>
    </div>
</x-admin.layout>
