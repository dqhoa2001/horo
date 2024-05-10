<x-admin.layout>
    <div class="container">
        <div class="row justify-content-center">
            <x-parts.admin_basic_card_layout>
                <x-slot name="cardHeader">
                    <h4 class="my-2">管理者クーポン編集</h4>
                </x-slot>
                <x-slot name="cardBody">
                    <form method="POST"
                        action="{{ route('admin.admin_coupons.update', ['admin_coupon'=> $adminCoupon]) }}"
                        enctype="multipart/form-data" id="admin-coupon-edit">
                        @csrf
                        @method('PATCH')
                        <div class="col-md-8 mb-3 mx-auto">
                            <label class="" for="coupon_name">クーポン名</label>
                            @include('components.form.text', ['name' => 'coupon_name', 'required' => true, 'value' =>
                            $adminCoupon->coupon_name])
                            @include('components.form.error', ['name' => 'coupon_name'])
                        </div>

                        <div class="col-md-8 mb-3 mx-auto">
                            <label class="" for="coupon_code">クーポンコード</label>
                            @include('components.form.text', ['name' => 'coupon_code', 'required' => true, 'value' =>
                            $adminCoupon->coupon_code])
                            @include('components.form.error', ['name' => 'coupon_code'])
                        </div>

                        <div class="col-md-8 mb-3 mx-auto">
                            <label class="" for="coupon_price">金額</label>
                            @include('components.form.number', ['name' => 'coupon_price', 'required' => true, 'value' =>
                            $adminCoupon->coupon_price])
                            @include('components.form.error', ['name' => 'coupon_price'])
                        </div>
                        
                        <div class="col-md-8 mb-3 mx-auto">
                            <label class="" for="user_id">ポイントバックする対象ユーザー</label>
                            @include('components.form.select', ['name' => 'user_id', 'required' => true, 'data' =>
                            $users, 'key'
                            => 'id', 'value' => 'full_name', 'selected' => $adminCoupon->user_id])
                            @include('components.form.error', ['name' => 'user_id'])
                        </div>

                        <div class="col-md-8 mb-3 mx-auto">
                            <label class="" for="back_point">バックポイント</label>
                            @include('components.form.number', ['name' => 'back_point', 'required' => true, 'value' =>
                            $adminCoupon->back_point])
                            @include('components.form.error', ['name' => 'back_point'])
                        </div>

                        <div class="col-md-8 mb-4 mx-auto">
                            <label class="" for="">対象サービス</label>

                            <div>
                                <input type="hidden" name="is_personal_appr_enabled" value="0">
                                <input class="me-2" type="checkbox" name="is_personal_appr_enabled" id="is_personal_appr_enabled" value="1" {{ old('is_personal_appr_enabled', $adminCoupon->is_personal_appr_enabled) ? 'checked' : '' }}>
                                <label for="is_personal_appr_enabled">個人鑑定</label>
                            </div>
                            <div>
                                <input type="hidden" name="is_family_appr_enabled" value="0">
                                <input class="me-2" type="checkbox" name="is_family_appr_enabled" id="is_family_appr_enabled" value="1" {{ old('is_family_appr_enabled', $adminCoupon->is_family_appr_enabled) ? 'checked' : '' }}>
                                <label for="is_family_appr_enabled">家族の個人鑑定</label>
                            </div>
                        </div>
                        
                        <div class="col-md-8 mb-3 mx-auto">
                            <label class="" for="is_infinite">使用期限を無期限に設定</label>
                            <input type="checkbox" name="is_infinite" id="is_infinite" value="1" v-on:click="toggleInput('no_infinity')" 
                            {{ old('is_infinite', $adminCoupon->time_limit_day->format('Y-m-d') == '2099-12-31' ? true : false) ? 'checked' : '' }}>
                            @include('components.form.error', ['name' => 'is_infinite'])
                        </div>
                        
                        @include('components.form.error', ['name' => 'time_limit_day'])
                        <div class="col-md-8 mb-3 mx-auto" v-if="inputs['no_infinity']">
                            <label class="" for="time_limit_day">使用期限</label>
                            @include('components.form.date', ['name' => 'time_limit_day', 'required' => false, 'value' =>
                            $adminCoupon->time_limit_day->format('Y-m-d')])
                        </div>

                        <div class="col-md-8 mb-3 mx-auto">
                            <label class="" for="use_limit">使用回数</label>
                            <p>※同一ユーザーがこのクーポンを何回使用できるか？を設定してください<br>※無効にしたい場合は「0」を、無制限にしたい場合は「99」にしてください</p>
                            @include('components.form.number', ['name' => 'use_limit', 'required' => true, 'value' =>
                            $adminCoupon->use_limit, 'min' => 0, 'max' => 99])
                            @include('components.form.error', ['name' => 'use_limit'])
                        </div>

                        <div class="text-center my-4">
                            <a href="{{ route('admin.admin_coupons.index') }}" class="btn btn-outline-secondary">
                                一覧へ戻る
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
    @section('script')
    <script>
        Vue.createApp({
            data() {
                return {
                    inputs: {
                        'no_infinity': @json(old('is_infinite', $adminCoupon->time_limit_day->format('Y-m-d') == '2099-12-31' ? false : true)),
                    }
                }
            },
            methods: {
                toggleInput: function(no_infinity) {
                    // 値を反転させる
                    this.inputs[no_infinity] = !this.inputs[no_infinity];
                }
            },
        }).mount('#admin-coupon-edit');
    </script>
    @endsection
</x-admin.layout>