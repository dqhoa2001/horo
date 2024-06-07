<div class="C-appraisal-history__mt">
    <div>個人鑑定ご購入後に、出生情報が間違っていたと判明した方は、無料で正しい情報の鑑定結果に修正いたしますので、お問い合わせください。
    <a class="C-appraisal-history__contact" href="{{ route('user.contacts.create') }}">お問い合わせはこちら ></a>
    (但し、生年月日の違いは対象外です。生まれた時間と、生まれた場所が間違っていた方の場合のみ対象となります)</div>
</div>
<br/>
<dl class="C-form-block C-form-block--birthdata">
    <dd class="C-form-block__body">
        <dl class="C-form-block-child C-form-block--birth">
            <dt class="C-solar-form__form">太陽回帰 鑑定履歴</dt>
            <div id="popup-horoscope">
            @foreach ($solarAppraisals as $SolarAppraisal)
                        @php
                            $solar_return = $SolarAppraisal->solar_return;
                            $birthday = $SolarAppraisal->birthday;
                            $birthdayDate = \Carbon\Carbon::parse($birthday);
                            $age = $solar_return - $birthdayDate->year;
                            if (\Carbon\Carbon::parse($solar_return . '-12-31')->lt($birthdayDate->copy()->year($solar_return))) {
                                $age--;
                            }
                            $url = route('user.solar_appraisals.show', $SolarAppraisal);
                        @endphp
                            <dl class="C-form-block C-form-block--birthdata">
                                <dd class="C-form-block__body">
                                    <dl class="C-form-block-child C-form-block--birth">
                                        <a href="{{ $url }}">
                                            <dd class="C-form-block__arrow01">
                                                <span>{{ $age }} 歳 {{ $solar_return }} -- {{ $solar_return + 1 }}</span>
                                            </dd>
                                        </a>
                                    </dl>
                                </dd>
                            </dl>
            @endforeach
            </div>
        </dl>
    </dd>
</dl>
