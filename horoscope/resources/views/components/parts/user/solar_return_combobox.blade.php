
@if (str_contains(Request::url(), 'solar_appraisals'))
<dl class="C-form-block C-form-block--birthdata">
    <dd class="C-form-block__body">
        <dl class="C-form-block-child C-form-block--birth">
            <dt class="C-solar-form__form">太陽回帰 鑑定年</dt>
            <div id="popup-horoscope">
            <dl class="C-form-block C-form-block--birthdata">
                <dd class="C-form-block__body">
                    <dl class="C-form-block-child C-form-block--birth">
                    <dl class="C-form-block C-form-block--birthdata">
                        <dd class="C-form-block__body">
                            <dl class="C-form-block-child C-form-block--birth">
                                <di>
                                    <div >
                                        <dd class="C-form-block__select01">
                                                <select id="solar_date" onchange="navigateToLink(this)">
                                                    <option value=""@if (empty($solarApply)) selected @endif>[SOLAR RETURN]を選択してください。</option>
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
                                                        <option value="{{ $url }}" @if (isset($solarApply)){{ $solarApply->id == $SolarAppraisal->id ? 'selected' : '' }}@endif>
                                                            {{ $age }} 歳 {{ $solar_return }} -- {{ $solar_return + 1 }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                        </dd>
                                    </div>
                                </div>
                            </dl>
                        </dd>
                    </dl>
                    </dl>
                </dd>
            </dl>
        </dl>
    </dd>
</dl>
@else
<dl class="C-form-block C-form-block--birthdata">
    <dd class="C-form-block__body">
        <dl class="C-form-block-child C-form-block--birth">
            <!-- <dt class="C-solar-form__form">太陽回帰 鑑定年</dt> -->
            <div id="popup-horoscope">
            <dl class="C-form-block C-form-block--birthdata">
                <dd class="C-form-block__body">
                    <dl class="C-form-block-child C-form-block--birth">
                    <dl class="C-form-block C-form-block--birthdata">
                        <dd class="C-form-block__body">
                            <dl class="C-form-block-child C-form-block--birth">
                                <div>
                                    <div class="div_left">
                                        <dd class="C-form-block__select01 C-form-block__select01-w">
                                            <select class="@if (!str_contains(Request::url(), 'my_horoscopes/edit')) active_Solar @endif" id="solar_date" onchange="navigateToLink(this)">
                                                    <option value=""@if (empty($solarApply)) selected @endif>[SOLAR RETURN]を選択してください。</option>
                                                    @foreach ($solarAppraisals as $SolarAppraisal)
                                                        @php
                                                                $solar_return = $SolarAppraisal->solar_return;
                                                                $birthday = $SolarAppraisal->birthday;
                                                                $birthdayDate = \Carbon\Carbon::parse($birthday);
                                                                $age = $solar_return - $birthdayDate->year;
                                                                if (\Carbon\Carbon::parse($solar_return . '-12-31')->lt($birthdayDate->copy()->year($solar_return))) {
                                                                    $age--;
                                                                }
                                                                $url = route('user.my_horoscopes.show', $SolarAppraisal);
                                                        @endphp
                                                        <option value="{{ $url }}" @if (isset($solarApply)){{ $solarApply->id == $SolarAppraisal->id ? 'selected' : '' }}@endif>
                                                            太陽回帰図 | {{ $age }} 歳 {{ $solar_return }} -- {{ $solar_return + 1 }}
                                                        </option>
                                                    @endforeach
                                            </select>
                                        </dd>
                                    </div>
                                </div>
                            </dl>
                        </dd>
                    </dl>
                    </dl>
                </dd>
            </dl>
        </dl>
    </dd>
</dl>
@endif
<script>
    function navigateToLink(select) {
        var url = select.value;
        if (url) {
            window.location.href = url;
        }
    }
</script>
