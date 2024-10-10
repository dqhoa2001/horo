<x-admin.layout>
    <div class="container">
        <div class="row justify-content-center">
            <x-parts.admin_basic_card_layout>
                <x-slot name="cardHeader">
                    <h4 class="my-2">会員登録クーポン編集</h4>
                </x-slot>
                <x-slot name="cardBody">
                    <form method="POST" action="{{ route('admin.register_coupons.update') }}">
                        @csrf
                        @method('PATCH')

                        <div class="col-md-8 mb-3 mx-auto">
                            <label class="" for="coupon_price">金額</label>
                            @include('components.form.number', ['name' => 'coupon_price', 'value' => $registerCoupon->coupon_price, 'required'
                            => true])
                            @include('components.form.error', ['name' => 'coupon_price'])
                        </div>

                        <div class="col-md-8 mb-3 mx-auto">
                            <label class="" for="back_point">バックポイント</label>
                            @include('components.form.number', ['name' => 'back_point', 'value' => $registerCoupon->back_point,
                            'required' => true])
                            @include('components.form.error', ['name' => 'back_point'])
                        </div>

                        <div class="col-md-8 mb-4 mx-auto">
                            <label class="" for="">対象サービス</label>

                            <div>
                                <input type="hidden" name="is_personal_appr_enabled" value="0">
                                <input class="me-2" type="checkbox" name="is_personal_appr_enabled" id="is_personal_appr_enabled" value="1" {{ old('is_personal_appr_enabled', $registerCoupon->is_personal_appr_enabled) ? 'checked' : '' }}>
                                <label for="is_personal_appr_enabled">個人鑑定</label>
                            </div>
                            <div>
                                <input type="hidden" name="is_family_appr_enabled" value="0">
                                <input class="me-2" type="checkbox" name="is_family_appr_enabled" id="is_family_appr_enabled" value="1" {{ old('is_family_appr_enabled', $registerCoupon->is_family_appr_enabled) ? 'checked' : '' }}>
                                <label for="is_family_appr_enabled">家族の個人鑑定</label>
                            </div>
                        </div>

                        <div class="col-md-8 mb-3 mx-auto">
                            <label class="" for="time_limit">使用期限 ※無期限に設定したい場合は「99」を入力ください</label>
                            @include('components.form.number', ['name' => 'time_limit', 'value' => $registerCoupon->time_limit,
                            'required' => true])
                            @include('components.form.error', ['name' => 'time_limit'])
                        </div>

                        <div class="col-md-8 mb-3 mx-auto">
                            <label class="" for="use_limit">使用回数</label>
                            <p>※同一ユーザーがこのクーポンを何回使用できるか？を設定してください<br>※無効にしたい場合は「0」を、無制限にしたい場合は「99」にしてください</p>
                            @include('components.form.number', ['name' => 'use_limit', 'value' => $registerCoupon->use_limit,
                            'required' => true, 'min' => 0, 'max' => 99])
                            @include('components.form.error', ['name' => 'use_limit'])
                        </div>

                        <div class="text-center my-4">
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                                戻る
                            </a>
                            <button type="submit" class="btn btn-dark">
                                更新する
                            </button>
                        </div>
                    </form>
                </x-slot>
            </x-parts.admin_basic_card_layout>
        </div>
    </div>
</x-admin.layout>