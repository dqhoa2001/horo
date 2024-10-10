<?php

namespace App\Mail\User;

use App\Models\BankInfo;
use App\Models\Template;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Library\CompileTemplate;
use App\Models\AppraisalClaim;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SolarAppraisalReceivedForBank extends Mailable implements ShouldQueue
{
    use Queueable;
    use SerializesModels;

    public BankInfo $bankInfo;

    public AppraisalClaim $appraisalClaim;

    public Template $template;

    public Template $footerTemplate;

    public array $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(BankInfo $bankInfo, AppraisalClaim $appraisalClaim)
    {
        $this->bankInfo = $bankInfo;
        $this->appraisalClaim = $appraisalClaim;
        $this->template = Template::where('class_name', class_basename($this))->first();
        $this->footerTemplate = Template::where('class_name', 'footer')->first();

        // テンプレートからメール本文を生成
        $this->data = [
            'name'               => $this->appraisalClaim->user->full_name,
            'contentType'        => $this->appraisalClaim->getContentTypeText(),
            'price'              => $this->appraisalClaim->price,
            'bank_name'          => $this->bankInfo->bank_name,
            'branch_name'        => $this->bankInfo->branch_name,
            'account_type'       => $this->bankInfo->account_type,
            'account_number'     => $this->bankInfo->account_number,
            'account_holder'     => $this->bankInfo->account_holder,
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
