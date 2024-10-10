@extends('errors.layout', ['title' => $message])
@section('message')
@php
    $statusCode = $exception->getStatusCode();
    $message = $exception->getMessage();
    switch ($statusCode) {
        case 400:
            $message = 'Bad Request';
            break;
        case 401:
            $message = '認証に失敗しました';
            break;
        case 403:
            $message = 'この操作を行う権限がありません';
            break;
        case 404:
            $message = '存在しないページです';
            break;
        case 408:
            $message = 'タイムアウトです';
            break;
        case 414:
            $message = 'リクエストURIが長すぎます';
            break;
        case 419:
            $message = '不正なリクエストです。';
            break;
        case 500:
            $message = 'サーバー側でエラーがおきました';
            break;
        case 502:
            $message = 'アクセスが集中しています';
            break;
        case 503:
            $message = '現在サービス停止中です。';
            break;
        default:
            $message = 'エラー';
        break;
    }
@endphp
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="row g-0">
                <div class="mb-3 py-3 col-md-4 d-flex align-items-center justify-content-center">
                    <img src="{{asset('mypage/assets/images/common/logo.svg')}}" style="margin-bottom:30px;">
                </div>
                <div class="py-3 col-md-4 d-flex align-items-center justify-content-center">
                    <img src="{{asset('images/common/im_sorry.svg')}}">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <div class="card-body">
                            <h3>エラーコード{{ $statusCode }} ：{{ $message }}</h3>
                            @if($statusCode == 419)
                                <p>前回から時間が経ち、セッションが切れたり、違うページから他のデータを処理しようとした可能性があります</p>
                                <p class="mt-4 text-center">再度ログインしてお試しください</p>
                            @elseif($statusCode == 500)
                                <p>エラーがおきました。<br>
                                <p>＊処理エラーが起こった場合、自動的に管理会社に通知されます。管理会社にて即時原因追求と対応を行います。エラー解消に３０分から数時間かかる場合がございます。しばらくおいて再度対象の操作をお願いします。お手数おかけします。</p>
                            @elseif($statusCode == 502)
                                <p>アクセスが集中しています</p>
                                <p>大変申し訳ございません。現在、製本のご注文が殺到しております。
                                    もう一度お試し頂くか、時間が経ってから再度ご注文をお願いします。</p>
                            @elseif($statusCode == 503)
                                <p>現在サービス停止中です<br>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
