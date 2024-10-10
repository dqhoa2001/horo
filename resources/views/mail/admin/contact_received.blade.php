{{ $contact->user->full_name }}様よりお問い合わせがありました。

▪️メールアドレス
{{ $contact->user->email }}

▪️お問い合わせ種別
{{ $contact->inquiryType->name }}

▪️内容
{!! nl2br(e($contact->content)) !!}
