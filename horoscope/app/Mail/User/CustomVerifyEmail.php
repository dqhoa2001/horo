<?php

namespace App\Mail\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Template;
use App\Models\User;
use App\Library\CompileTemplate;

class CustomVerifyEmail extends Mailable implements ShouldQueue
{
    use Queueable;
    use SerializesModels;

    public Template $template;

    public array $data;

    public string $verificationUrl;

    public Template $footerTemplate;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $verificationUrl)
    {
        $this->template = Template::where('class_name', class_basename($this))->first();
        $this->footerTemplate = Template::where('class_name', 'footer')->first();
        $this->verificationUrl = $verificationUrl;
        $this->bcc(config('mail.minna_bcc'));

        // テンプレートからメール本文を生成
        $this->data = [
            'verification_url'   => $this->verificationUrl,
            'homepage_url'       => config('app.home_url'),
            'contact_url'        => route('user.contacts.create'),
            'admin_email'        => config('app.email'),

        ];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $compiledData = CompileTemplate::compileTemplateWithFooter($this->template->content, $this->footerTemplate->content, $this->data);
        return $this->subject($this->template->title)->view('mail.template', [
                    'compiledData' => $compiledData,
                ]);
    }
}
