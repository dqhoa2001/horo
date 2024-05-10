<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminMailController\StoreRequest;
use App\Http\Requests\Admin\AdminMailController\UpdateRequest;
use App\Models\AdminMail;
use Illuminate\Http\Request;

class AdminMailController extends Controller
{
    private AdminMail $adminMail;

    /**
     * @param AdminMail $adminMail
     */
    public function __construct(AdminMail $adminMail)
    {
        $this->adminMail = $adminMail;
    }

    /**
     * 一覧
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.admin_mails.index', [
            'adminMails' => AdminMail::latest()->paginate(12),
        ]);
    }

    /**
     * 登録フォーム表示
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {        
        return view('admin.admin_mails.create');
    }

    /**
     * 登録
     *
     * @param StoreRequest $request
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $this->adminMail->fill($request->substitutable())->save();

        return to_route('admin.admin_mails.index')->with('status', '作成しました');
    }

    /**
     * 編集フォーム表示
     *
     * @return \Illuminate\View\View
     */
    public function edit(AdminMail $adminMail)
    {
        return view('admin.admin_mails.edit', [
            'adminMail' => $adminMail,
        ]);
    }

    /**
     * 更新
     *
     * @param UpdateRequest $request
     * @param AdminMail $adminMail
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, AdminMail $adminMail)
    {
        $adminMail->fill($request->substitutable())->save();

        return back()->with('status', '更新しました');
    }

    /**
     * 削除
     *
     * @param AdminMail $adminMail
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(AdminMail $adminMail)
    {
        $adminMail->delete();

        return to_route('admin.admin_mails.index')->with('status', '削除しました');
    }
}