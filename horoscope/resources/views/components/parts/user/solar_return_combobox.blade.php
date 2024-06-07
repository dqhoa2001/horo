
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
                                                        <option value="{{ $url }}" {{ $solarApply->id == $SolarAppraisal->id ? 'selected' : '' }}>
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
<script>
    function navigateToLink(select) {
        console.log('test');
        var url = select.value;
        if (url) {
            window.location.href = url;
        }
    }
</script>
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
                                        <dd class="C-form-block__select01">
                                            <form id="solarDateForm" action="{{ route('user.my_solar_horoscopes.edit', $solarApply->id) }}" method="GET">
                                                <select class="solarOptions" name="solar_date" id="solar_date" v-model="selectedSolarDate" ref="solar_date" :disabled="isSelectBoxDisabled" @change="submitForm" onchange="document.getElementById('solarDateForm').submit()">
                                                    @php
                                                        $solarDates = $solarDates->sortByDesc(function ($yearSolarDate) use ($userBirthYear) {
                                                            return $yearSolarDate - $userBirthYear;
                                                        });
                                                    @endphp
                                                        <option class="solar-option" >
                                                            太陽回帰図 | Please choose
                                                        </option>
                                                    @foreach ($solarDates as $yearSolarDate)
                                                        @php
                                                            $age = $yearSolarDate - $userBirthYear;
                                                        @endphp
                                                        <option class="solar-option" value="{{ $yearSolarDate }}" {{ $solarApply->solar_date == $yearSolarDate ? 'selected' : '' }}>
                                                        太陽回帰図 | {{ $age }} 歳 {{ $yearSolarDate }} -- {{ $yearSolarDate + 1 }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </form>
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
<script>
    function updateOptions() {
        var options = document.querySelectorAll('.solar-option');
        var screenWidth = window.innerWidth;

        options.forEach(function(option) {
            var originalText = option.textContent;
            if (screenWidth <= 500) {
                option.textContent = originalText.replace('太陽回帰図 | ', '');
            } else {
                if (!option.textContent.includes('太陽回帰図 | ')) {
                    option.textContent = '太陽回帰図 | ' + originalText;
                }
            }
        });
    }

    // Cập nhật khi tải trang và khi thay đổi kích thước màn hình
    window.onload = updateOptions;
    window.onresize = updateOptions;
</script>
@endif
