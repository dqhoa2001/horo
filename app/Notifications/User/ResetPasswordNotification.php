<?php

namespace App\Notifications\User;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends ResetPassword
{
    /**
     * Get the reset password notification mail message for the given URL.
     *
     * @param string $url
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    protected function buildMailMessage($url)
    {
        return (new MailMessage())
            ->subject(config('app.name') . ' パスワード再設定')
            ->line('パスワード再設定のリクエストを受け付けました。')
            ->action('パスワード再設定', $url)
            ->line('このリンクの有効期限は ' . config('auth.passwords.' . config('auth.defaults.passwords') . '.expire') . ' 分です。')
            ->line('パスワードのリセットにお心当たりが無い場合は、このメールを無視してください。');
    }

    /**
     * Get the reset URL for the given notifiable.
     *
     * @param mixed $notifiable
     *
     * @return string
     */
    protected function resetUrl($notifiable)
    {
        if (static::$createUrlCallback) {
            return \call_user_func(static::$createUrlCallback, $notifiable, $this->token);
        }

        return url(route('user.password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));
    }
}