<x-admin.layout>
    <div class="container">
        <div class="row justify-content-center">
            <x-parts.admin_basic_card_layout>
                <x-slot name="cardHeader">
                    <h4 class="my-2">管理者クーポン作成</h4>
                </x-slot>
                <x-slot name="cardBody">
                    <form method="POST" action="{{ route('admin.admin_coupons.store') }}" enctype="multipart/form-data" id="admin-coupon-create">
                        @csrf

                        
                        <div class="col-md-8 mb-3 mx-auto">
                            <label class="" for="coupon_name">クーポン名</label>
                            @include('components.form.text', ['name' => 'coupon_name', 'required' => true])
                            @include('components.form.error', ['name' => 'coupon_name'])
                        </div>
                        
                        <div class="col-md-8 mb-3 mx-auto">
                            <label class="" for="coupon_code">クーポンコード</label>
                            @include('components.form.text', ['name' => 'coupon_code', 'required' => true])
                            @include('components.form.error', ['name' => 'coupon_code'])
                        </div>
                        
                        <div class="col-md-8 mb-3 mx-auto">
                            <label class="" for="coupon_price">金額</label>
                            @include('components.form.number', ['name' => 'coupon_price', 'required' => true])
                            @include('components.form.error', ['name' => 'coupon_price'])
                        </div>
                        
                        @if(isset($user))
                            <div class="col-md-8 mb-3 mx-auto">
                                <label class="" for="user_id">ポイントバックする対象ユーザー</label>
                                <select name="user_id" id="user_id" class="form-control" disabled>
                                    <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                </select>
                            </div>
                        @else
                        <div class="col-md-8 mb-3 mx-auto">
                            <label class="" for="user_id">ポイントバックする対象ユーザー</label>
                            @include('components.form.select', [
                                'name' => 'user_id',
                                'required' => true,
                                'data' => $users,
                                'key' => 'id',
                                'value' => 'full_name',
                                'selected' => $selectedUserId
                            ])
                            @include('components.form.error', ['name' => 'user_id'])
                        </div>
                        @endif

                        <div class="col-md-8 mb-4 mx-auto">
                            <label class="" for="back_point">バックポイント</label>
                            @include('components.form.number', ['name' => 'back_point', 'required' => true])
                            @include('components.form.error', ['name' => 'back_point'])
                        </div>

                        <div class="col-md-8 mb-4 mx-auto">
                            <label class="" for="">対象サービス</label>

                            {{-- <div>
                                <input type="hidden" name="is_register_and_personal_appr_enabled" value="0">
                                <input class="me-2" type="checkbox" name="is_register_and_personal_appr_enabled" id="is_personal_appr_enabled" value="1" checked>
                                <label for="is_personal_appr_enabled">会員登録+個人鑑定</label>
                            </div>
                            <div>
                                <input type="hidden" name="is_register_and_family_appr_enabled" value="0">
                                <input class="me-2" type="checkbox" name="is_register_and_family_appr_enabled" id="is_personal_appr_enabled" value="1" checked>
                                <label for="is_personal_appr_enabled">会員登録+家族の個人鑑定</label>
                            </div> --}}
                            <div>
                                <input type="hidden" name="is_personal_appr_enabled" value="0">
                                <input class="me-2" type="checkbox" name="is_personal_appr_enabled" id="is_personal_appr_enabled" value="1" checked>
                                <label for="is_personal_appr_enabled">個人鑑定</label>
                            </div>
                            <div>
                                <input type="hidden" name="is_family_appr_enabled" value="0">
                                <input class="me-2" type="checkbox" name="is_family_appr_enabled" id="is_family_appr_enabled" value="1" checked>
                                <label for="is_family_appr_enabled">家族の個人鑑定</label>
                            </div>

                        </div>

                        <div class="col-md-8 mb-3 mx-auto">
                            <label class="" for="is_infinite">使用期限を無期限に設定</label>
                            <input type="checkbox" name="is_infinite" id="is_infinite" value="1" v-on:click="toggleInput('no_infinity')">
                            @include('components.form.error', ['name' => 'is_infinite'])
                        </div>

                        <div class="col-md-8 mb-3 mx-auto" v-if="inputs['no_infinity']">
                            <label class="" for="time_limit_day">使用期限</label>
                            @include('components.form.date', ['name' => 'time_limit_day', 'required' => false])
                            @include('components.form.error', ['name' => 'time_limit_day'])
                        </div>

                        <div class="col-md-8 mb-3 mx-auto">
                            <label class="" for="use_limit">使用回数</label>
                            <p>※同一ユーザーがこのクーポンを何回使用できるか？を設定してください<br>※無効にしたい場合は「0」を、無制限にしたい場合は「99」にしてください</p>
                            @include('components.form.number', ['name' => 'use_limit', 'required' => true, 'min' => 0, 'max' => 99, 'value' => 99])
                            @include('components.form.error', ['name' => 'use_limit'])
                        </div>

                        <div class="text-center my-4">
                            @if(isset($user))
                                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                                    戻る
                                </a>
                                <input type="hidden" name="user_id" key="id" value="{{ $user->id }}">
                            @else
                                <a href="{{ route('admin.admin_coupons.index') }}" class="btn btn-outline-secondary">
                                    一覧へ戻る
                                </a>
                            @endif
                            <button type="submit" class="btn btn-dark">
                                登録する
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
                        'no_infinity': true,
                    }
                }
            },
            methods: {
                toggleInput: function(no_infinity) {
                    // 値を反転させる
                    this.inputs[no_infinity] = !this.inputs[no_infinity];
                }
            },
        }).mount('#admin-coupon-create');
    </script>
    @endsection
</x-admin.layout>