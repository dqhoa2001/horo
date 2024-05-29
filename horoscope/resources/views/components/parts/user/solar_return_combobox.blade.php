<dl class="C-form-block C-form-block--birthdata">
    <dd class="C-form-block__body">
        <dl class="C-form-block-child C-form-block--birth">
            <dt class="C-solar-form__message">太陽回帰 鑑定年</dt>
            <div id="popup-horoscope">
            <dl class="C-form-block C-form-block--birthdata">
                <dd class="C-form-block__body">
                    <dl class="C-form-block-child C-form-block--birth">
                    <dl class="C-form-block C-form-block--birthdata">
                        <dd class="C-form-block__body">
                            <dl class="C-form-block-child C-form-block--birth">
                                <div>
                                    <div style="display: flex">
                                        <dd class="C-form-block__select01">
                                            <form id="solarDateForm" action="{{ route('user.solar_appraisals.show', $solarApply->id) }}" method="GET">
                                                <select name="solar_date" id="solar_date" onchange="document.getElementById('solarDateForm').submit()">
                                                    @php
                                                        $solarDates = $solarDates->sortByDesc(function ($yearSolarDate) use ($userBirthYear) {
                                                            return $yearSolarDate - $userBirthYear;
                                                        });
                                                    @endphp
                                                    @foreach ($solarDates as $yearSolarDate)
                                                        @php
                                                            $age = $yearSolarDate - $userBirthYear;
                                                        @endphp
                                                        <option value="{{ $yearSolarDate }}" {{ $solarApply->solar_date == $yearSolarDate ? 'selected' : '' }}>
                                                            {{ $age }} 歳 {{ $yearSolarDate }} -- {{ $yearSolarDate + 1 }}
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
