<div class="C-appraisal-history__mt">
    <div>個人鑑定ご購入後に、出生情報が間違っていたと判明した方は、無料で正しい情報の鑑定結果に修正いたしますので、お問い合わせください。
        <a class="C-appraisal-history__contact" href="{{ route('user.contacts.create') }}">お問い合わせはこちら ></a>
        (但し、生年月日の違いは対象外です。生まれた時間と、生まれた場所が間違っていた方の場合のみ対象となります)
    </div>
</div>
<br />
<dl class="C-form-block C-form-block--birthdata">
    <dd class="C-form-block__body">
        <dl class="C-form-block-child C-form-block--birth">
            <dt class="C-solar-form__form">太陽回帰 鑑定履歴</dt>
            <div id="popup-horoscope">
                @foreach ($solarAppraisals as $SolarAppraisal)
                    @php
                        $solar_return = $SolarAppraisal->solar_return + 1;
                        $birthday = $SolarAppraisal->birthday;
                        $birthdayDate = \Carbon\Carbon::parse($birthday);
                        $age = $solar_return - $birthdayDate->year;

                        if (\Carbon\Carbon::now()->isBefore($birthdayDate->copy()->year($solar_return)->endOfYear())) {
                        $age--;
                        $solar_return--;
                        }

                        $currentYearFormattedDate = $birthdayDate->copy()->year($solar_return)->format('Y年m月d日');

                        $nextYearEndDate = $birthdayDate->copy()->year($solar_return + 1)->subDay()->format('Y年m月d日');

                        $url = route('user.solar_appraisals.show', $SolarAppraisal);
                    @endphp

                    <dl class="C-form-block C-form-block--birthdata">
                        <dd class="C-form-block__body">
                            <dl class="C-form-block-child C-form-block--birth">
                                <a href="{{ $url }}">
                                    <dd class="C-form-block__arrow01">
                                        <span> {{ $age }}歳　({{$currentYearFormattedDate}}　-　{{ $nextYearEndDate}})</span>                                 
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