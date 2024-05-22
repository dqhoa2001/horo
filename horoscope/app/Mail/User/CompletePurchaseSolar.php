<?php

namespace App\Mail\User;

use App\Models\Template;
use App\Models\SolarApply;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Library\CompileTemplate;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class CompletePurchaseSolar extends Mailable implements ShouldQueue
{
    use Queueable;
    use SerializesModels;

    public SolarApply $solarApply;

    public Template $template;

    public Template $footerTemplate;

    public array $data;

    /**
     * Create a new message instance.
     */
    public function __construct(SolarApply $solarApply)
    {
        $this->solarApply = $solarApply;
        // dd($this->SolarApply->reference->full_name);
        $this->bcc(config('mail.minna_bcc'));
        $this->template = Template::where('class_name', class_basename($this))->first();
        $this->footerTemplate = Template::where('class_name', 'footer')->first();

        // テンプレートからメール本文を生成
        $this->data = [
            'full_name' => $this->solarApply->reference->full_name,
            'homepage_url'       => config('app.home_url'),
            'contact_url'        => route('user.contacts.create'),
            'login_url'          => route('user.login'),
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
