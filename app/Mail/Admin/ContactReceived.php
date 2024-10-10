<?php

namespace App\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Contact;
use App\Models\Template;
use App\Library\CompileTemplate;

class ContactReceived extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public Contact $contact;

    public Template $template;

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

        // テンプレートからメール本文を生成
        $this->data = [
            'name'               => $this->contact->user->full_name,
            'email'              => $this->contact->user->email,
            'inquiry_type_name'  => $this->contact->inquiryType->name,
            'content'            => $this->contact->content,
        ];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $compiledData = CompileTemplate::compileTemplate($this->template->content, $this->data);
        return $this->subject($this->template->title)->view('mail.template', [
                    'compiledData' => $compiledData,
                ]);
    }
}
