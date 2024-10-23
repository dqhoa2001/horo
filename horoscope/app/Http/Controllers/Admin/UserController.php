<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;

use Illuminate\Http\File;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Models\AppraisalClaim;
use App\Mail\User\PayStatusChange;
use App\Http\Controllers\Controller;
use App\Models\BookbindingUserApply;
use Illuminate\Http\RedirectResponse;
use App\Services\AppraisalApplyService;
use App\Services\AppraisalClaimService;
use App\Services\BookbindingUserApplyService;
use App\Http\Requests\Admin\UserController\UpdateRequest;

class UserController extends Controller
{
    public function __construct(
        protected AppraisalClaimService $appraisalClaimService,
        protected AppraisalApplyService $appraisalApplyService,
    ) {
    }

    /**
     * 一覧
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request): View
    {
        $searchName = [
            'searchName' => $request->input('searchName'),
            'general' => $request->input('general'),
            'influencer' => $request->input('influencer'),
            'withdraw' => $request->input('withdraw'),
            'searchEmail' => $request->input('searchEmail'),
            'userBookbindings' => $request->input('userBookbindings'),
        ];
        
        session(['searchName' => $searchName]);
        
        $users = UserService::search($searchName)->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.users.index', [
            'users' => $users,
        ]);
    }

    /**
     * 編集フォーム表示
     *
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', [
            'user' => $user,
        ]);
    }

    /**
     * 更新
     *
     * @param UpdateRequest $request
     * @param User $user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, User $user)
    {
        $user->fill($request->substitutable())->save();
        return back()->with('status', '更新しました');
    }

    /**
     * 削除
     *
     * @param User $user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        $user->delete();

        return to_route('admin.users.index')->with('status', '削除しました');
    }

    /**
     * 製本の発送ステータス変更
     *
     * @param BookbindingUserApply $bookbindingUserApply
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeDeliveryStatus(BookbindingUserApply $bookbindingUserApply)
    {
        if ($bookbindingUserApply->is_delivery) {
            $bookbindingUserApply->is_delivery = false;
        } else {
            $bookbindingUserApply->is_delivery = true;
        }
        $bookbindingUserApply->save();

        return back()->with('status', '発送状態を更新しました');
    }

    public function changePayStatus(AppraisalClaim $appraisalClaim): RedirectResponse
    {
        $message = \DB::transaction(static function () use ($appraisalClaim) {

            if ($appraisalClaim->is_paid) {
                $appraisalClaim->is_paid = false;
                $appraisalClaim->paid_at = null;
            } else {
                $appraisalClaim->is_paid = true;
                $appraisalClaim->paid_at = today();
            }
            $appraisalClaim->save();
            
            if ($appraisalClaim->is_paid) {
                \Mail::to($appraisalClaim->user->email)->send(new PayStatusChange($appraisalClaim));
            }
    
            // 一括製本の場合、その他の製本も支払状態を更新
            $message = '支払状態を更新しました';
            if ($appraisalClaim->is_paid && $appraisalClaim->isBookbinding()) {
                $bookbindingUserApply = $appraisalClaim->bookbindingUserApply;

                if ($bookbindingUserApply->bulk_binding_key !== null) {
                    $bulkBookbindingUserApplies = BookbindingUserApply::where('bulk_binding_key', $bookbindingUserApply->bulk_binding_key)->get();
                    foreach ($bulkBookbindingUserApplies as $bookbindingUserApply) {
                        $bookbindingUserApply->appraisalClaim->update([
                            'is_paid' => true,
                            'paid_at' => today(),
                        ]);
                    }
                }
    
                $message = '支払いが完了しました。しばらくして製本が発送されます';
            }

            // 一括で支払いを取り消した場合、その他の製本も支払状態を更新
            if ($appraisalClaim->is_paid === false && $appraisalClaim->isBookbinding()) {
                $bookbindingUserApply = $appraisalClaim->bookbindingUserApply;
                if ($bookbindingUserApply->bulk_binding_key !== null) {
                    $bulkBookbindingUserApplies = BookbindingUserApply::where('bulk_binding_key', $bookbindingUserApply->bulk_binding_key)->get();
                    foreach ($bulkBookbindingUserApplies as $bookbindingUserApply) {
                        $bookbindingUserApply->appraisalClaim->update([
                            'is_paid' => false,
                            'paid_at' => null,
                        ]);
                    }
                }

                $message = '支払いを取り消しました。';
            }

            return $message;
        });

        return back()->with('status', $message);
    }

    /**
     * 未払会員一覧画面の表示
     *
     * @return \Illuminate\View\View
     */
    public function unpaidAppraisalList(Request $request): View
    {
        $searchName = [
            'searchName' => $request->input('searchName'),
            'general' => $request->input('general'),
            'influencer' => $request->input('influencer'),
            'withdraw' => $request->input('withdraw'),
            'searchEmail' => $request->input('searchEmail'),
        ];
        
        $appraisalClaims = AppraisalClaimService::search($searchName)->where('is_paid', false)->latest()->paginate(20);
        return view('admin.users.unpaid_appraisal_list', [
            'appraisalClaims' => $appraisalClaims,
        ]);
    }

    /**
     * 退会取り消し
     *
     * @param User $user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(User $user): RedirectResponse
    {
        $user = User::withTrashed()->findOrFail($user->id);
        if ($user->canRestore()) {
            $user->restore();
        } else {
            return back()->with('flash_alert', '退会取り消しに失敗しました');
        }
        return back()->with('status', '退会を取り消しました');
    }
}
