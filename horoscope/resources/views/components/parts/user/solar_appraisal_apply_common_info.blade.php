
<div class="C-user-list">
    <div class="C-user-list-block">
        <span class="C-user-list-block__inner C-user-list-block__hasimage">
            <figure class="C-user-list-block__image"><img
                    src="{{ asset('mypage/assets/images/solar-return/img_thumbnail.svg') }}" alt="画像"></figure>
            <div class="C-user-list-block__hasimage__inner">
                <h3 class="C-user-list-block__title" data-tag="Name"><span>{{ $solarApply->reference->name1 }}　{{  $solarApply->reference->name2 }}</span>さん</h3>
                    <div class="C-user-list-block__content">
                        @if ($solarApply->reference->relationship)
                        <p class="C-user-list-block__item" data-tag="Relationship">
                            {{$solarApply->reference->relationship}}</p>
                        @endif
                        <p class="C-user-list-block__item" data-tag="Birthday">
                            {{$solarApply->birthday->format('Y-m-d') }}
                        </p>
                        <p class="C-user-list-block__item" data-tag="Birth Time">
                            {{ $solarApply->birthday_time->format('H:i') }}
                        </p>
                        <p class="C-user-list-block__item" data-tag="Location">
                            {{ $solarApply->birthday_prefectures }}
                        </p>
                    </div>
            </div>
        </span>
    </div>
</div>
