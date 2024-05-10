@extends('layouts.default')
@section('content')
    <div style="text-align:center;padding:50px 20% 20px 20%">
        <p class="title_caption">
            お名前と出生情報を入力してください<br>
            (生年月日は西暦で入力してください。例:1980.01.01)
        </p>
        <hr style="margin-top: 20px; margin-bottom: 20px;border: 0;border-top: 1px solid #eee;">
    </div>


    @include('forms.horoscope')
@stop
