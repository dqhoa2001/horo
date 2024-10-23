<?php

namespace App\Mail\User;

use App\Models\User;
use App\Models\Template;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Library\CompileTemplate;
use App\Models\BookbindingUserApply;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BookbindingUserApplyMailForBankComplete extends Mailable implements ShouldQueue
{
    use Queueable;
    use SerializesModels;

    public BookbindingUserApply $bookbindingUserApply;

    public User $user;

    public Template $template;

    public Template $footerTemplate;

    public array $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(BookbindingUserApply $bookbindingUserApply, User $user)
    {
        $this->bookbindingUserApply = $bookbindingUserApply;
        $this->user = $user;
        $this->template = Template::where('class_name', ($this->bookbindingUserApply->appraisalApply->solar_return != 0) ? 'BookbindingUserApplySolarMailForBankComplete' : class_basename($this))->first();
        $this->footerTemplate = Template::where('class_name', 'footer')->first();

        // テンプレートからメール本文を生成
        $this->data = [
            'full_name'          => $this->user->full_name,
            'purchase_name'      => $this->bookbindingUserApply->name,
            'post_number'        => $this->bookbindingUserApply->post_number,
            'address'            => $this->bookbindingUserApply->address,
            'building'            => $this->bookbindingUserApply->building,
            'tel'                => $this->bookbindingUserApply->tel,
            'scheduled_shipping_date' => $this->bookbindingUserApply->scheduled_shipping_date->format('Y年m月d日'),
            // 'scheduled_shipping_date' => $this->bookbindingUserApply->scheduled_shipping_date,
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
