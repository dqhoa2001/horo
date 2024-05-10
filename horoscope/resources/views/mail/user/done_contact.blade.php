{{ $contact->user->name1 }}{{ $contact->user->name2 }}様

いつもご利用ありがとうございます。星の舞です。

お問い合わせありがとうございます。
以下の内容でお問い合わせを受け付けました、返信までしばらくお待ちください。

▪️お問い合わせ種別
{{ $contact->inquiryType->name }}

▪️内容
{!! nl2br(e($contact->content)) !!}

@include('mail.text.footer')
