@extends('horoscope::layouts.master')

@section('content')
    @if (session()->has('status') && session()->has('message'))
        <h1>{{ session('message') }}</h1>
    @endif
    <div class="container horoscope-form">
        <form name="horoscope" class="custom" method="POST" action="{{ route('horoscope-submit') }}">
            @csrf
            {{-- name --}}
            <div class="row field">
                <label for="name">
                    <strong>お名前
                    </strong>
                </label>
                <input name="name" type="text" value={{ old('name', session('name')) }}>
            </div>
            @error('name')
                <span style="color: red" class="text-danger">{{ $message }}</span>
            @enderror

            {{-- day of birth --}}
            <div class="row field">
                <label for="day_of_birth">
                    <strong>生年月日</strong>
                </label>
            </div>
            @if (!$errors->has('year') && !$errors->has('month') && !$errors->has('day'))
                @error('day_of_birth')
                    <span style="color: red" class="text-danger">{{ $message }}</span>
                @enderror
            @endif
            {{-- year --}}
            <div class="row field">
                <label for="year">
                    <strong>年</strong>
                </label>
                <input name="year" type="number" value={{ old('year', session('year')) }}>
            </div>
            @error('year')
                <span style="color: red" class="text-danger">{{ $message }}</span>
            @enderror
            {{-- month --}}
            <div class="row field">
                <label for="month">
                    <strong>月
                    </strong>
                </label>
                <input name="month" type="number" value={{ old('month', session('month')) }}>
            </div>
            @error('month')
                <span style="color: red" class="text-danger">{{ $message }}</span>
            @enderror
            {{-- day --}}
            <div class="row field">
                <label for="day">
                    <strong>日</strong>
                </label>
                <input name="day" type="number" value={{ old('day', session('day')) }}>
            </div>
            @error('day')
                <span style="color: red" class="text-danger">{{ $message }}</span>
            @enderror
            <div class="row field">
                <label >
                    <strong>時刻</strong>
                </label>
            </div>
            {{-- hour --}}
            <div class="row field">
                <label for="hour">
                    <strong>時</strong>
                </label>
                <input name="hour" type="number" value={{ old('hour', session('hour')) }}>
            </div>
            @error('hour')
                <span style="color: red" class="text-danger">{{ $message }}</span>
            @enderror
            {{-- minute --}}
            <div class="row field">
                <label for="minute">
                    <strong>分</strong>
                </label>
                <input name="minute" type="number" value={{ old('minute', session('minute')) }}>
            </div>
            @error('minute')
                <span style="color: red" class="text-danger">{{ $message }}</span>
            @enderror
            <div class="row field">
                <label >
                    <strong>地名で検索
                    </strong>
                </label>
                <input id="searchMapInput" type="text">
                <button id="searchMapBtn" type="button">検索</button>
            </div>
            <div class="row map-view">
                <div id="map" style="height: 500px; width:500px"></div>
            </div>

            <div class="row field">
                <label for="longitude">
                    <strong>経度</strong>
                </label>
                <input id="map-longitude" disabled type="text"
                    value={{ old('longitude', session('longitude')) ?? '138.252924' }}>
                <input id="lng" hidden name="longitude" type="text"
                    value={{ old('longitude', session('longitude')) ?? '138.252924' }}>
            </div>
            @error('longitude')
                <span style="color: red" class="text-danger">{{ $message }}</span>
            @enderror
            <div class="row field">
                <label for="latitude">
                    <strong>緯度</strong>
                </label>
                <input id="map-latitude" disabled type="text"
                    value={{ old('latitude', session('latitude')) ?? '36.204824' }}>
                <input id="lat" hidden name="latitude" type="text"
                    value={{ old('latitude', session('latitude')) ?? '36.204824' }}>
            </div>
            @error('latitude')
                <span style="color: red" class="text-danger">{{ $message }}</span>
            @enderror
            <input id="map-city" hidden name="map-city" type="text" value="">
            <div class="row field">
                <label for="timezone">
                    <strong>タイムゾーン
                    </strong>
                </label>
                <select name="timezone">
                    @foreach (Modules\Horoscope\Enums\Time::Time as $item)
                        <option value='{{ $item['value'] }}' {{ array_key_exists('selected', $item) ? 'selected' : '' }}>
                            {{ $item['label'] }}
                        </option>
                    @endforeach
                </select>
            </div>
            @error('timezone')
                 <span style="color: red" class="text-danger">{{ $message }}</span>
            @enderror
            <div>
                <input type="radio" id="normal" name="background" value="normal" checked>
                <label for="normal">すっきりシンプルなホロスコープ</label><br>
                <input type="radio" id="background" name="background" value="background">
                <label for="background">星空のイメージのホロスコープ</label><br>
            </div>

            <div class="row button">
                <button class="horoscope-btn">ホロスコープを表示</button>
            </div>
        </form>
    </div>
@endsection
