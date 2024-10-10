<x-admin.layout>
    <div class="container">
        <div class="row justify-content-center">
            <x-parts.admin_basic_card_layout>
                <x-slot name="cardHeader">
                    <h4 class="my-2">管理者メール編集</h4>
                </x-slot>
                <x-slot name="cardBody">
                    <form method="POST" action="{{ route('admin.admin_mails.update', $adminMail) }}"  enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="col-md-8 mb-3 mx-auto">
                            <label class="" for="email">メールアドレス</label>
                            @include('components.form.text', ['name' => 'email', 'value' => $adminMail->email, 'required' => true])
                            @include('components.form.error', ['name' => 'email'])
                        </div>

                        <div class="text-center my-4">
                            <a href="{{ route('admin.admin_mails.index') }}" class="btn btn-outline-dark">一覧へ戻る</a>
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
