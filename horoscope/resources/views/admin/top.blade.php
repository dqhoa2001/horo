<x-admin.layout>
    <div class="container">
        <div class="row justify-content-center">
            <x-parts.admin_basic_card_layout>
                <x-slot name="cardHeader">
                    <h4 class="my-2">管理者ダッシュボード</h4>
                </x-slot>
                <x-slot name="cardBody">
                    <div class="row justify-content-around mb-5">
                        <div class="col-3 me-5">
                            <a href="{{ route('admin.register_coupons.edit') }}" class="card shadow text-decoration-none list-group-item-action h-100">
                                <div class="card-header text-center">
                                    <h1 class="mb-0 display-2"><i class="fa-solid fa-ticket me-1"></i></h1>
                                    <h5 class="mb-0">会員登録クーポン管理</h5>
                                </div>
                                <div class="card-body text-dark text-center">
                                    <p>クーポンの登録、編集、削除を行います</p>
                                </div>
                            </a>
                        </div>
                        
                        <div class="col-3 me-5">
                            <a href="{{ route('admin.admin_coupons.index') }}" class="card shadow text-decoration-none list-group-item-action h-100">
                                <div class="card-header text-center">
                                    <h1 class="mb-0 display-2"><i class="fas fa-user"></i><i class="fa-solid fa-ticket me-1"></i></h1>
                                    <h5 class="mb-0">管理者クーポン管理</h5>
                                </div>
                                <div class="card-body text-dark text-center">
                                    <p>クーポンの登録、編集、削除を行います</p>
                                </div>
                            </a>
                        </div>
                        
                        <div class="col-3 me-5">
                            <a href="{{ route('admin.users.index') }}" class="card shadow text-decoration-none list-group-item-action h-100">
                                <div class="card-header text-center">
                                    <h1 class="mb-0 display-2"><i class="fa fa-users me-1"></i></h1>
                                    <h5 class="mb-0">会員管理</h5>
                                </div>
                                <div class="card-body text-dark text-center">
                                    <p>会員の一覧、詳細情報を確認できます</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </x-slot>
            </x-parts.admin_basic_card_layout>
        </div>
    </div>
</x-admin.layout>