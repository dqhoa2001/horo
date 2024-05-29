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
                @foreach ($solarDates as $date)
                <dl class="C-form-block C-form-block--birthdata">
                    <dd class="C-form-block__body">
                        <dl class="C-form-block-child C-form-block--birth">
                            <div style="display: flex">
                                <label name="solar_date" id="solar_date">
                                    <output value="{{ $date }}">
                                            @php
                                                $age = $date - $userBirthYear;
                                            @endphp
                                            <option value="{{ $date }}" {{ $solarApply->solar_date == $date ? 'selected' : '' }}>
                                                {{ $age }} 歳 {{ $date }} -- {{ $date + 1 }}
                                            </option>
                                    </output>
                                </label>
                                <dd class="C-form-block__arrow">
                                </dd>
                            </div>
                        </dl>
                    </dd>
                </dl>
                @endforeach
            </div>
        </dl>
    </dd>
</dl>
