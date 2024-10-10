<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserChangeEmailMail extends Mailable
{
    use Queueable, SerializesModels;

    private string $token;

    /**
     * Create a new message instance.
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * Build the message.
     * 
     * @return $this
     */
    public function build()
    {
        return $this->from(config('mail.from.address')) // 送信元
            ->subject('【星の舞】メールアドレス変更のお知らせ') // メールタイトル
            ->view('mail.text.change_email') // メール本文のテンプレート
            ->with(['url' => config('app.url') . env('APP_PORT') . '/user/emails/' . $this->token]);  // withでセットしたデータをviewへ渡す
    }
}
