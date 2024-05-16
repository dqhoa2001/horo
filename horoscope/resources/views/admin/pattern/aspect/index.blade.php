<x-admin.layout>
    <div class="d-flex justify-content-between align-items-center">
        <h1>@lang('table.aspect_pattern_list')</h1>
        <a href="{{ route('admin.pattern.aspect-view') }}" class="btn btn-primary">作成する</a>
    </div>
    <div class="card">
        <div class="card-body">
            <x-admin.toast />
                    <form action="{{ route('admin.pattern.aspect-list') }}" method="GET" class="mb-3">
                        <div class="row">
                            <div class="col">
                                <select name="from_planet_id" class="form-select">
                                    <option value="">惑星名から</option>
                                    @foreach($planets as $planet)
                                        <option value="{{ $planet->id }}" {{ $selectedValues['from_planet_id'] == $planet->id ? 'selected' : '' }}>
                                            {{ $planet->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <select name="to_planet_id" class="form-select">
                                    <option value="">惑星名へ</option>
                                    @foreach($planets as $planet)
                                        <option value="{{ $planet->id }}" {{ $selectedValues['to_planet_id'] == $planet->id ? 'selected' : '' }}>
                                            {{ $planet->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <select name="aspect_id" class="form-select">
                                    <option value="">アスペクト</option>
                                    @foreach($aspects as $aspect)
                                        <option value="{{ $aspect->id }}" {{ $selectedValues['aspect_id'] == $aspect->id ? 'selected' : '' }}>
                                            {{ $aspect->name }}
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
                                <a class="btn btn-success" href="{{ route('admin.pattern.aspect-list') }}">リセット</a>
                            </div>
                        </div>
                    </form>
            <x-admin.table>
                <x-slot name='header'>
                    <tr>
                        <th class="text-center"style="width: 5%">No</th>
                        <th class="text-center" style="width: 8%">@lang('table.from_planet_name')</th>
                        <th class="text-center" style="width: 8%">@lang('table.to_planet_name')</th>
                        <th class="text-center" style="width: 8%">@lang('table.aspect_name')</th>
                        <th class="text-center">@lang('table.content')</th>
                        <th class="text-center">@lang('table.content_en')</th>
                        <th class="text-center">@lang('table.content_solar')</th>
                        <th class="text-center">@lang('table.content_solar_en')</th>
                        <th class="text-center">@lang('table.action')</th>
                    </tr>
                </x-slot>
                <x-slot name='body'>
                    @if (isset($aspectPatterns) && !empty($aspectPatterns))
                        @foreach ($aspectPatterns as $index => $pattern)
                            <tr>
                                <td class="text-center">{{ $pattern->id}}</td>
                                @if (!session()->has('lang_code') || session('lang_code') == 'ja')
                                    <td class="text-center">{{ $pattern->fromPlanet->name }}</td>
                                    <td class="text-center">{{ $pattern->toPlanet->name }}</td>
                                    <td class="text-center"> {{ $pattern->aspect->name }}</td>
                                @else
                                    <td class="text-center">{{ $pattern->fromPlanet->name_en }}</td>
                                    <td class="text-center">{{ $pattern->toPlanet->name_en }}</td>
                                    <td class="text-center"> {{ $pattern->aspect->name_en }}</td>
                                @endif
                                <td class="text-left">{!! nl2br(e($pattern->content)) !!}</td>
                                <td class="text-left">{!! nl2br(e($pattern->content_en)) !!}</td>
                                <td class="text-left">{!! nl2br(e($pattern->content_solar)) !!}</td>
                                <td class="text-left">{!! nl2br(e($pattern->content_solar_en)) !!}</td>
                                <td class="text-center">
                                    <div class="btn-group">
                                    <a href={{ route('admin.pattern.aspect-view', $pattern->id) }}>
                                        <button type="button" class="btn btn-success mx-1">
                                            <i class="bi bi-pencil-fill"></i>
                                        </button>
                                    </a>
                                    <button type="button" class="btn btn-danger mx-1" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $id = $pattern->id }}"
                                    data-action={{ $action = route('admin.pattern.aspect-delete', $pattern->id) }}>
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
                    @include('Includes.admin.paginate', ['paginate' => $aspectPatterns])
                </x-slot>
            </x-admin.table>
        </div>
    </div>

</x-admin.layout>
