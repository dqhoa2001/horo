<?php

namespace App\Mail\User;

use App\Models\User;
use App\Models\BankInfo;
use App\Models\Template;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\AppraisalClaim;
use App\Library\CompileTemplate;
use App\Library\GetAppraisalRoute;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\AdminMail;

class PayStatusChange extends Mailable implements ShouldQueue
{
    use Queueable;
    use SerializesModels;

    public AppraisalClaim $appraisalClaim;

    public Template $template;

    public Template $footerTemplate;

    public array $allAdminMailAddresses;

    public string $minnaBcc;

    public array $data;

    public array $minnaBccArray;

    public array $bccMails;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(AppraisalClaim $appraisalClaim)
    {
        $this->allAdminMailAddresses = AdminMail::pluck('email')->toArray();
        $this->minnaBcc = config('mail.minna_bcc');
        $this->minnaBccArray = [$this->minnaBcc]; // 文字列を配列に変換
        $this->bccMails = array_merge($this->allAdminMailAddresses, $this->minnaBccArray);

        $this->bcc($this->bccMails);
        $this->template = Template::where('class_name', class_basename($this))->first();
        $this->footerTemplate = Template::where('class_name', 'footer')->first();

        $this->appraisalClaim = $appraisalClaim;
        // テンプレートからメール本文を生成
        $this->data = [
            'name'               => $this->appraisalClaim->user->full_name,
            'appraisal_url'      => GetAppraisalRoute::getAppraisalRoute($this->appraisalClaim->appraisalApply),
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
