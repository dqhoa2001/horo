<div class="mb-3">
    <form method="GET" action="" id="search-form">

        <div class="form-inlin mb-3">

            @if(isset($users))
            <div class="mb-3 mr-3">
                <label for="" class="form-check-label mr-3">会員名</label>
                <input type="text" name="searchName" value="{{ $users ?? ""}}" class="form-control" />
            </div>
            @endif

            @if(isset($userEmail))
            <div class="mb-3 mr-3">
                <label for="" class="form-check-label mr-3">メールアドレス</label>
                <input type="text" name="searchEmail" value="{{ $userEmail ?? ""}}" class="form-control" />
            </div>
            @endif

            @if(isset($adminCoupons))
            <div class="mb-3 mr-3">
                <label for="" class="form-check-label mr-3">クーポン名</label>
                <input type="text" name="adminCoupon" value="{{ $adminCoupons ?? ""}}" class="form-control" />
            </div>
            @endif

            @if(isset($adminCouponCode))
            <div class="mb-3 mr-3">
                <label for="" class="form-check-label mr-3">クーポンコード</label>
                <input type="text" name="adminCouponCode" value="{{ $adminCouponCode ?? ""}}" class="form-control" />
            </div>
            @endif

            @if(isset($general) && isset($influencer) && isset($withdraw) && isset($userBookbindings))
            <div class="mb-3 mr-3">
                <p style="margin-bottom:0px">種別</p>
                <span style="padding-left:10px">
                    <input type="checkbox" name="general" id="general" @if($general === 'on') checked
                    @endif />
                    <label for="general" class="form-check-label mr-3">一般</label>
                </span>
                <span style="padding-left:10px">
                    <input type="checkbox" name="influencer" id="influencer" @if($influencer === 'on') checked
                        @endif />
                    <label for="influencer" class="form-check-label mr-3">インフルエンサー</label>
                </span>
                <span style="padding-left:10px">
                    <input type="checkbox" name="withdraw" id="withdraw" @if($withdraw === 'on') checked
                        @endif />
                    <label for="withdraw" class="form-check-label mr-3">退会済みユーザー</label>
                </span>

                <span style="padding-left:10px">
                    <input type="checkbox" name="userBookbindings" id="userBookbindings" @if($userBookbindings === 'on') checked
                        @endif />
                    <label for="userBookbindings" class="form-check-label mr-3">製本購入済み</label>
                </span>
                
            </div>
            @endif




        </div>

        <div class="row justify-content-center">
            <button class="btn btn-dark w-25 me-4">検索</button>
            <a href="{{ route($route) }}" class="btn btn-outline-secondary w-25" name="reset">リセット</a>
        </div>
    </form>
</div>