<x-admin.layout>
    <div class="container" id="user-edit">
        <div class="row justify-content-center">
            <x-parts.admin_basic_card_layout>
                <x-slot name="cardHeader">
                    <h4 class="my-2">会員情報</h4>
                    <div>
                        <a href="{{ route('admin.admin_coupons.create', ['user' => $user->id]) }}" class="btn btn-primary">管理者クーポンを作成する</a>
                        <a href="{{ route('admin.users.index', session('searchName')) }}" class="btn btn-outline-secondary">会員一覧に戻る</a>
                    </div>
                </x-slot>
                <x-slot name="cardBody">
                    {{-- ローディングの表示 --}}
                    @include('components.admin.loading')
                    @if($user->trashed())
                        <div class="alert alert-danger">
                            <h4 class="alert-heading"><i class="fa-solid fa-triangle-exclamation me-2"></i>退会済みユーザーです</h4>
                            @if ($user->canRestore())
                                <form action="{{ route('admin.users.restore', ['user' => $user]) }}" method="post" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-success" onclick="return confirm('本当に復活させますか？')">退会復活</button>
                                </form>
                            @else
                                <p>
                                    このメールアドレスは他のユーザーが使用中です。<br>
                                    重複していないメールアドレスに変更いただけると、復会ボタンが現れます。
                                </p>
                            @endif
                        </div>
                    @endif
                    <form action="{{ route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="mb-5">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-5 text-md-end">
                                        <label for="last_name" class="col-form-label">性</label>
                                    </div>
                                    <div class="col-md-6 align-self-center">
                                        {{ $user->name1 }}
                                    </div>
                                </div>
                            </div>

                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-5 text-md-end">
                                        <label for="first_name" class="col-form-label">名</label>
                                    </div>
                                    <div class="col-md-6 align-self-center">
                                        {{ $user->name2 }}
                                    </div>
                                </div>
                            </div>

                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-5 text-md-end">
                                        <label for="member_type" class="col-form-label">種別</label>
                                    </div>
                                    <div class="col-md-6 align-self-center">
                                        @include('components.form.radio', [
                                            'name' => 'member_type',
                                            'data' => \App\Models\User::TYPE,
                                            'checked' => $user->member_type,
                                        ])
                                    </div>
                                </div>
                            </div>

                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-5 text-md-end">
                                        <label for="email" class="col-form-label">メールアドレス</label>
                                    </div>
                                    <div class="col-md-4 align-self-center">
                                        @include('components.form.text', ['name' => 'email', 'value' => $user->email, 'required' => true])
                                        @include('components.form.error', ['name' => 'email'])
                                    </div>
                                </div>
                            </div>

                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-5 text-md-end">
                                        <label for="last_name" class="col-form-label">生年月日</label>
                                    </div>
                                    <div class="col-md-6 align-self-center">
                                        {{ $user->birthday ? $user->birthday->format('Y年m月d日') : ''  }}
                                    </div>
                                </div>
                            </div>

                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-5 text-md-end">
                                        <label for="last_name" class="col-form-label">出生時刻</label>
                                    </div>
                                    <div class="col-md-6 align-self-center">
                                        {{ $user->birthday_time?->format('H時i分') }}
                                    </div>
                                </div>
                            </div>

                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-5 text-md-end">
                                        <label for="last_name" class="col-form-label">出身地</label>
                                    </div>
                                    <div class="col-md-6 align-self-center">
                                        {{ $user->full_birthday_place }}
                                    </div>
                                </div>
                            </div>

                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-5 text-md-end">
                                        <label for="last_name" class="col-form-label">ポイント残高</label>
                                    </div>
                                    <div class="col-md-4 align-self-center">
                                        @include('components.form.number', ['name' => 'point_sum', 'value' => $user->point_sum, 'required' => true])
                                        @include('components.form.error', ['name' => 'point_sum'])
                                    </div>
                                </div>
                            </div>
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-5 text-md-end">
                                        <label for="last_name" class="col-form-label">会員登録クーポン</label>
                                    </div>
                                    <div class="col-md-6 align-self-center">
                                        {{ $user->welcome_code }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-5 text-md-end">
                                        <label for="last_name" class="col-form-label">会員クーポン使用状況</label>
                                    </div>
                                    <div class="col-md-6 align-self-center">
                                        {{ $user->is_used_welcome_code ? '使用済み' : '未使用' }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-5 text-md-end">
                                        <label for="last_name" class="col-form-label">メモ</label>
                                    </div>
                                    <div class="col-md-6 align-self-center">
                                        @include('components.form.textarea', ['name' => 'memo', 'value' => $user->memo])
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center my-4">
                            <button type="submit" class="btn btn-dark">
                                更新する
                            </button>
                        </div>
                    </form>

                    <div class="mb-5">
                        <h4>購入履歴</h4>
                        <x-parts.basic_table_layout>
                            <x-slot name="thead">
                                <tr>
                                    <th scope="col" class="text-nowrap text-center">編集</th>
                                    <th scope="col" class="text-nowrap text-center">購入履歴No</th>
                                    {{-- 製本関係は一時コメントアウト --}}
                                    {{-- <th scope="col" class="text-nowrap text-center">製本発送状況</th> --}}
                                    <th scope="col" class="text-nowrap text-center">支払い状況の確認</th>
                                    <th scope="col" class="text-nowrap text-center">購入内容</th>
                                    <th scope="col" class="text-nowrap text-center">購入時期</th>
                                    <th scope="col" class="text-nowrap text-center">購入金額</th>
                                    <th scope="col" class="text-nowrap text-center">支払い方法</th>
                                    <th scope="col" class="text-nowrap text-center">製本PDFダウンロード</th>
                                    <th scope="col" class="text-nowrap text-center">製本の送付先情報</th>
                                </tr>
                            </x-slot>
                            <x-slot name="tbody">
                                @foreach ($user->appraisalClaims as $appraisalClaim)
                                    <tr>
                                        <td class="text-nowrap px-2 text-center">
                                            <a href="{{ route('admin.appraisal_applies.edit', $appraisalClaim->appraisalApply) }}" class="btn btn-success btn-sm">編集</a>
                                        </td>
                                        <td class="text-nowrap px-2 text-center">{{ $appraisalClaim->id }}</td>
                                        {{-- 製本関係は一時コメントアウト --}}
                                        {{-- <td class="text-nowrap px-2 text-center">
                                            @if ($appraisalClaim->isBookbinding())
                                                <form action="{{ route('admin.users.change_delivery_status', $appraisalClaim->bookbindingUserApply) }}" method="POST" class="mb-0">
                                                    @csrf
                                                    @method('PATCH')

                                                    <select name="delivery_status"
                                                            id="delivery_status"
                                                            class="form-control @error('delivery_status') is-invalid @enderror
                                                            {{ \App\Models\BookbindingUserApply::DELIVERY_STATUS_COLOR[$appraisalClaim->bookbindingUserApply->is_delivery] }}"

                                                            onchange="confirmSubmit(this);" >
                                                        @foreach(\App\Models\BookbindingUserApply::DELIVERY_STATUSES as $k => $v)
                                                            <option value="{{ $k }}"
                                                                    @if($appraisalClaim->bookbindingUserApply->is_delivery === $k ) selected @elseif($loop->iteration == 1) selected @endif>
                                                                {{ $v }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </form>
                                            @endif
                                        </td> --}}
                                        <td class="text-nowrap px-2 text-center">
                                            <form action="{{ route('admin.users.change_pay_status', $appraisalClaim) }}" method="POST" class="mb-0" id="change-pay-form{{ $appraisalClaim->id }}">
                                                @csrf
                                                @method('PATCH')

                                                <select name="pay_status"
                                                        id="pay_status"
                                                        class="form-control @error('pay_status') is-invalid @enderror {{ $appraisalClaim->getPayStatusColor() }} text-center"
                                                        @change="confirmSubmit({{ $appraisalClaim->id }});" >

                                                    @foreach(\App\Models\AppraisalClaim::PAY_STATUSES as $k => $v)
                                                        <option value="{{ $v }}"
                                                                @if($appraisalClaim->is_paid === $v ) selected @elseif($loop->iteration == 1) selected @endif>
                                                            {{ $k }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </form>
                                        </td>
                                        <td class="text-nowrap px-2 text-center">{{ $appraisalClaim->getContentTypeText() }}・{{ $appraisalClaim->appraisalApply->reference->full_name ?? '' }}</td>
                                        <td class="text-nowrap px-2 text-center">{{ $appraisalClaim->purchase_date->format('Y年m月d日') }}</td>
                                        <td class="text-nowrap px-2 text-center">{{ number_format($appraisalClaim->price) }}円</td>
                                        <td class="text-nowrap px-2 text-center">{{ $appraisalClaim->getPaymentTypeText() }}</td>
                                        <td class="text-nowrap px-2 text-center">
                                            @if ($appraisalClaim->isBookbinding() && $appraisalClaim->bookbinding_user_apply_id)
                                            <form action="{{ route('admin.appraisal_applies.download_pdf', $appraisalClaim->bookbindingUserApply) }}" method="POST" class="mb-0">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">ダウンロード</button>
                                            </form>
                                            @endif
                                        </td>
                                        {{-- 製本関係は一時コメントアウト --}}
                                        <td class="text-nowrap px-2 text-center">
                                            @if ($appraisalClaim->isBookbinding() && $appraisalClaim->bookbinding_user_apply_id)
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#claimModal{{ $appraisalClaim->id }}">
                                                    送付先情報
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="claimModal{{ $appraisalClaim->id }}" tabindex="-1" aria-labelledby="claimModal{{ $appraisalClaim->id }}Label" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="claimModal{{ $appraisalClaim->id }}Label">送付先情報</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-body">
                                                                    <div class="row">
                                                                        <div class="col-md-5 text-md-end">
                                                                            <label for="first_name" class="col-form-label">名前</label>
                                                                        </div>
                                                                        <div class="col-md-2 align-self-center">
                                                                            {{ $appraisalClaim->bookbindingUserApply->name }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-body">
                                                                    <div class="row">
                                                                        <div class="col-md-5 text-md-end">
                                                                            <label for="first_name" class="col-form-label">郵便番号</label>
                                                                        </div>
                                                                        <div class="col-md-2 align-self-center">
                                                                            {{ $appraisalClaim->bookbindingUserApply->post_number }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-body">
                                                                    <div class="row">
                                                                        <div class="col-md-5 text-md-end">
                                                                            <label for="first_name" class="col-form-label">住所</label>
                                                                        </div>
                                                                        <div class="col-md-5 align-self-center text-md-start text-wrap">
                                                                            {{ $appraisalClaim->bookbindingUserApply->address }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-body">
                                                                    <div class="row">
                                                                        <div class="col-md-5 text-md-end">
                                                                            <label for="first_name" class="col-form-label">建物・マンション名</label>
                                                                        </div>
                                                                        <div class="col-md-5 align-self-center text-md-start text-wrap">
                                                                            {{ $appraisalClaim->bookbindingUserApply->building }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-body">
                                                                    <div class="row">
                                                                        <div class="col-md-5 text-md-end">
                                                                            <label for="first_name" class="col-form-label">電話番号</label>
                                                                        </div>
                                                                        <div class="col-md-2 align-self-center">
                                                                            {{ $appraisalClaim->bookbindingUserApply->tel }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </x-slot>
                        </x-parts.basic_table_layout>
                    </div>

                    @if ($user->member_type === \App\Models\User::INFLUENCER)
                        <div class="mb-5">
                            <h4>クーポン使用回数</h4>
                            <x-parts.basic_table_layout>
                                <x-slot name="thead">
                                    <tr>
                                        <th scope="col" class="text-nowrap text-center">集計月</th>
                                        <th scope="col" class="text-nowrap text-center">使用回数</th>
                                        <th scope="col" class="text-nowrap text-center">詳細</th>
                                    </tr>
                                </x-slot>
                                <x-slot name="tbody">
                                    @foreach ($user->getUsedCouponLogs() as $usedMonth => $usedCouponLog)
                                        <tr>
                                            <td class="text-nowrap px-2 text-center">{{ $usedMonth }}</td>
                                            <td class="text-nowrap px-2 text-center">{{ $usedCouponLog->count() }}</td>
                                            <td class="text-nowrap px-2 text-center">
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#usedCouponModal{{ $usedMonth }}">
                                                    詳細
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="usedCouponModal{{ $usedMonth }}" tabindex="-1" aria-labelledby="usedCouponModal{{ $usedMonth }}Label" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="usedCouponModal{{ $usedMonth }}Label">詳細</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-body">
                                                                    @foreach ($usedCouponLog as $usedCouponLogDetail)
                                                                        <div class="row mb-2">
                                                                            <div class="col-md-6 text-md-end">
                                                                                {{ $usedCouponLogDetail['purchase_date'] }}
                                                                            </div>
                                                                            <div class="col-md-6 text-md-start">
                                                                                {{ $usedCouponLogDetail['user_name'] }}
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                    @endforeach
                                </x-slot>
                            </x-parts.basic_table_layout>
                            <div class="row justify-content-center">
                                {{ $user->getUsedCouponLogs()->appends(request()->query())->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    @endif
                </x-slot>
            </x-parts.admin_basic_card_layout>
        </div>
    </div>

    <script src="https://unpkg.com/vue@3"></script>
    <script>
        Vue.createApp({
            data() {
                return {
                    isLoading: false
                }
            },
            methods: {
                confirmSubmit(appraisalClaimId) {
                    if (confirm('更新しますか？')) {
                        this.isLoading = true;
                        document.getElementById('change-pay-form'+appraisalClaimId).submit();
                    } else {
                        // 確認で「キャンセル」が選ばれた場合、何もせずに終了
                        return false;
                    }
                }
            }
        }).mount('#user-edit')

    </script>
</x-admin.layout>
