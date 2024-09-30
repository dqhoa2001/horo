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
        $className = $appraisalClaim->appraisalApply->solar_return !== 0 ? 'BookbindingUserApplySolarMailForBankComplete' : class_basename($this) ;
        $this->template = Template::where('class_name', $className)->first();
        $this->footerTemplate = Template::where('class_name', 'footer')->first();

        $this->appraisalClaim = $appraisalClaim;
        $router = $appraisalClaim->appraisalApply->solar_return !== 0 ? route('user.solar_appraisals.show', $this->appraisalClaim->appraisalApply) : GetAppraisalRoute::getAppraisalRoute($this->appraisalClaim->appraisalApply);
        // テンプレートからメール本文を生成
        $this->data = [
            'name'               => $this->appraisalClaim->user->full_name,
            'appraisal_url'      => $router,
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
