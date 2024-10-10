<x-admin.layout>
    <div class="container">
        <div class="row justify-content-center">
            <x-parts.admin_basic_card_layout>
                <x-slot name="cardHeader">
                    <h4 class="my-2">管理者クーポン一覧：{{ $adminCoupons->total() . '件中' . $adminCoupons->firstItem() . '-' .
                        $adminCoupons->lastItem() }}件</h4>
                    <a href="{{ route('admin.admin_coupons.create') }}" class="btn btn-primary">作成する</a>
                </x-slot>
                <x-slot name="cardBody">
                    @include('components.parts.search_box',['adminCoupons' => \Request::GET('adminCoupon')??'', 'users' => \Request::GET('searchName') ??'','adminCouponCode' => \Request::GET('adminCouponCode')??'', 'route'=>'admin.admin_coupons.index'])
                    <x-parts.basic_table_layout>
                        <x-slot name="thead">
                            <tr>
                                <th scope="col" class="text-nowrap">クーポン名</th>
                                <th scope="col" class="text-nowrap">クーポンコード</th>
                                <th scope="col" class="text-nowrap">金額</th>
                                <th scope="col" class="text-nowrap">ポイントバックする対象ユーザー</th>
                                <th scope="col" class="text-nowrap">バックポイント</th>
                                {{-- <th scope="col" class="text-nowrap">使用日数</th> --}}
                                <th scope="col" class="text-nowrap">使用期限</th>
                                <th scope="col" class="text-nowrap">使用回数</th>
                                <th scope="col" class="text-nowrap">編集</th>
                                <th scope="col" class="text-nowrap">削除</th>
                            </tr>
                        </x-slot>
                        <x-slot name="tbody">
                            @if($adminCoupons->isNotEmpty())
                            @foreach($adminCoupons as $adminCoupon)
                            <tr>
                                <td class="text-nowrap px-2">{{ $adminCoupon->coupon_name }}</td>
                                <td class="text-nowrap px-2">{{ $adminCoupon->coupon_code }}</td>
                                <td class="text-nowrap px-2">{{ $adminCoupon->coupon_price }}</td>
                                <td class="text-nowrap px-2">
                                    <a href="{{ route('admin.users.edit', $adminCoupon->user->id) }}">
                                        {{ $adminCoupon->user->full_name }}
                                    </a>
                                </td>
                                <td class="text-nowrap px-2">{{ $adminCoupon->back_point }}</td>
                                {{-- <td class="text-nowrap px-2">{{ ($adminCoupon->time_limit)}}日</td> --}}
                                <td class="text-nowrap px-2">{{ $adminCoupon->time_limit_day->format('Y年m月d日') }}</td>
                                <td class="text-nowrap px-2">{{ $adminCoupon->use_limit }}回</td>
                                <td class="text-nowrap px-2">
                                    <a href="{{ route('admin.admin_coupons.edit', ['admin_coupon' => $adminCoupon->id]) }}" class="btn btn-dark btn-sm">
                                       編集
                                    </a>
                                </td>
                                <td class="text-nowrap px-2">
                                    <form action="{{ route('admin.admin_coupons.destroy', $adminCoupon) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('本当に削除しますか？')">削除</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </x-slot>
                    </x-parts.basic_table_layout>
                    <div class="row justify-content-center">
                        {{ $adminCoupons->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>
                </x-slot>
            </x-parts.admin_basic_card_layout>
        </div>
    </div>
</x-admin.layout>