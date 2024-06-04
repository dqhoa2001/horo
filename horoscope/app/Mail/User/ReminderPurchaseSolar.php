<?php

namespace App\Mail\User;

use App\Library\CompileTemplate;
use App\Models\Template;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReminderPurchaseSolar extends Mailable implements ShouldQueue
{
    use Queueable;
    use SerializesModels;

    public Template $template;

    public Template $footerTemplate;

    public array $data;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user)
    {
        $this->template = Template::where('class_name', class_basename($this))->first();
        $this->footerTemplate = Template::where('class_name', 'footer')->first();
        $this->data = [
            'full_name'          => $user->full_name,
            'homepage_url'       => config('app.home_url'),
            'admin_email'        => config('app.email')
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
