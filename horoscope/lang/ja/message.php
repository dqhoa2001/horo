<?php
use PHPUnit\Framework\TestStatus\Success;

return [
    'string' => ':attributeフィールドは文字列である必要があります。',
    'required' => ':attributeフィールドは必須です',
    'numeric' => ':attributeフィールドには数字を入力する必要があります。',
    'date' => ':attributeフィールドは有効な日付である必要があります。',
    'email' => ':attributeフィールドは有効な電子メール アドレスである必要があります。',
    'unique' => ':attributeはすでに取得されています。',
    'max_mb' => ':attributeフィールドは:max文字以下である必要があります。',
];
