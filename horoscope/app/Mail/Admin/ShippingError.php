<?php

namespace App\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Contact;
use App\Models\Template;
use App\Library\CompileTemplate;

class ShippingError extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public Template $template;

    public string $firstErrorInfo;

    public array $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $firstErrorInfo)
    {
        $this->firstErrorInfo = $firstErrorInfo;
        $this->template = Template::where('class_name', class_basename($this))->first();

        // テンプレートからメール本文を生成
        $this->data = [
            'firstErrorInfo' => $firstErrorInfo,
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
