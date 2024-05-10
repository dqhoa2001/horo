<?php

namespace App\Mail\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Contact;
use App\Models\Template;
use App\Library\CompileTemplate;

class DoneContact extends Mailable implements ShouldQueue
{
    use Queueable;
    use SerializesModels;

    public Contact $contact;

    public Template $template;

    public Template $footerTemplate;

    public array $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
        $this->bcc(config('mail.minna_bcc'));
        $this->template = Template::where('class_name', class_basename($this))->first();
        $this->footerTemplate = Template::where('class_name', 'footer')->first();

        // テンプレートからメール本文を生成
        $this->data = [
            'name'               => $this->contact->user->full_name,
            'email'              => $this->contact->user->email,
            'inquiry_type_name'  => $this->contact->inquiryType->name,
            'content'            => $this->contact->content,
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
