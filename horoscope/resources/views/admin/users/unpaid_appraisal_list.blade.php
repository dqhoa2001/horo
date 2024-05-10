<x-admin.layout>
    <div class="container">
        <div class="row justify-content-center">
            <x-parts.admin_basic_card_layout>
                <x-slot name="cardHeader">
                    <h4 class="my-2">未払会員一覧：{{ $appraisalClaims->total() . '件中' . $appraisalClaims->firstItem() . '-' . $appraisalClaims->lastItem() }}件</h4>
                </x-slot>
                <x-slot name="cardBody">
                    <x-parts.basic_table_layout>
                        <x-slot name="thead">
                            <tr>
                                <th scope="col" class="text-nowrap text-center">購入履歴No</th>
                                <th scope="col" class="text-nowrap text-center">ユーザー名</th>
                                <th scope="col" class="text-nowrap text-center">メールアドレス</th>
                                <th scope="col" class="text-nowrap text-center">支払い状況の確認</th>
                                <th scope="col" class="text-nowrap text-center">購入内容</th>
                                <th scope="col" class="text-nowrap text-center">購入時期</th>
                                <th scope="col" class="text-nowrap text-center">購入金額</th>
                                <th scope="col" class="text-nowrap text-center">支払い方法</th>
                            </tr>
                        </x-slot>
                        <x-slot name="tbody">
                            @include('components.parts.search_box',['users'=> \Request::get('searchName')?? '',
                            'general' => \Request::get('general') ?? '', 'influencer' => \Request::get('influencer') ?? '', 'withdraw' => \Request::get('withdraw') ?? '',
                            'userEmail' => \Request::get('searchEmail') ?? '', 'route' => 'admin.users.unpaid_appraisal_list'])
                            @foreach ($appraisalClaims as $appraisalClaim)
                                <tr>
                                    <td class="text-nowrap px-2 text-center">{{ $appraisalClaim->id }}</td>
                                    <td class="text-nowrap px-2">
                                        <a href="{{ route('admin.users.edit', ['user' => $appraisalClaim->user]) }}">
                                            {{ $appraisalClaim->user->full_name }}
                                            @if($appraisalClaim->user->trashed())
                                                (退会済み)
                                            @endif
                                        </a>
                                    </td>
                                    <td class="text-nowrap px-2">{{ $appraisalClaim->user->email }}</td>
                                    <td class="text-nowrap px-2 text-center">
                                        <form action="{{ route('admin.users.change_pay_status', $appraisalClaim) }}" method="POST" class="mb-0">
                                            @csrf
                                            @method('PATCH')

                                            <select name="pay_status"
                                                    id="pay_status"
                                                    class="form-control @error('pay_status') is-invalid @enderror {{ $appraisalClaim->getPayStatusColor() }} text-center"
                                                    onchange="confirmSubmit(this);" >
                                                @foreach(\App\Models\AppraisalClaim::PAY_STATUSES as $k => $v)
                                                    <option value="{{ $v }}"
                                                            @if($appraisalClaim->is_paid === $v ) selected @elseif($loop->iteration == 1) selected @endif>
                                                        {{ $k }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </form>
                                    </td>
                                    <td class="text-nowrap px-2 text-center">{{ $appraisalClaim->getContentTypeText() }}</td>
                                    <td class="text-nowrap px-2 text-center">{{ $appraisalClaim->purchase_date->format('Y年m月d日') }}</td>
                                    <td class="text-nowrap px-2 text-center">{{ number_format($appraisalClaim->price) }}円</td>
                                    <td class="text-nowrap px-2 text-center">{{ $appraisalClaim->getPaymentTypeText() }}</td>
                                </tr>
                            @endforeach
                        </x-slot>
                    </x-parts.basic_table_layout>
                    <div class="row justify-content-center">
                        {{ $appraisalClaims->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>
                </x-slot>
            </x-parts.admin_basic_card_layout>
        </div>
    </div>
    <script>
        function confirmSubmit(selectElement) {
            if (confirm('更新しますか？')) {
                selectElement.form.submit();
            } else {
                // 確認で「キャンセル」が選ばれた場合、何もせずに終了
                return false;
            }
        }
    </script>
</x-admin.layout>
