<?php

namespace App\Http\Controllers\User;

use App\Models\Contact;
use App\Models\AdminMail;
use Illuminate\View\View;
use App\Models\InquiryType;
use Illuminate\Http\Request;
use App\Mail\User\DoneContact;
use App\Mail\Admin\ContactReceived;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\User\ContactController\StoreRequest;
use App\Http\Requests\User\ContactController\ConfirmRequest;

class ContactController extends Controller
{
    private Contact $contact;

    /**
     * @param Contact $contact
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    // お問い合わせフォーム表示
    public function create(): View
    {
        return view('user.contacts.create', [
            'inquiryTypes' => InquiryType::all(),
        ]);
    }

    // お問い合わせ内容確認画面表示
    public function confirm(ConfirmRequest $request): View
    {
        $params = $request->substitutable();

        return view('user.contacts.confirm', [
            'params'      => $params,
            'inquiryType' => InquiryType::find($params['inquiry_type_id']),
        ]);
    }

    // 確認画面から、修正して戻る
    public function back(Request $request): RedirectResponse
    {
        return to_route('user.contacts.create')->withInput();
    }

    // お問い合わせ登録
    public function store(StoreRequest $request): RedirectResponse
    {
        $this->contact->fill($request->substitutable())->save();

        \Mail::to(auth()->guard('user')->user()->email)->send(new DoneContact($this->contact));

        $allAdminMailAddresses = AdminMail::pluck('email')->toArray();
        \Mail::to($allAdminMailAddresses)->send(new ContactReceived($this->contact));

        return to_route('user.contacts.complete');
    }

    // お問い合わせ完了画面
    public function complete(): View
    {
        return view('user.contacts.complete');
    }
}
