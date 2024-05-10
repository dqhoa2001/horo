<div class="C-user-list">
    <div class="C-user-list-block">
        <span class="C-user-list-block__inner C-user-list-block__hasimage">
            <figure class="C-user-list-block__image"><img
                    src="{{ asset('mypage/assets/images/familyappraisal/img_thumbnail.svg') }}" alt="画像"></figure>
            <div class="C-user-list-block__hasimage__inner">
                <h3 class="C-user-list-block__title" data-tag="Name"><span>{{ $appraisalApply->reference->name1 }} {{ $appraisalApply->reference->name2 }}</span>さん</h3>
                <div class="C-user-list-block__content">
                    <p class="C-user-list-block__item" data-tag="Birthday">
                        {{ $appraisalApply->birthday->format('Y-m-d') }}
                    </p>
                    <p class="C-user-list-block__item" data-tag="Birth Time">
                        {{ $appraisalApply->birthday_time->format('H:i') }}
                    </p>
                    <p class="C-user-list-block__item" data-tag="Location">
                        {{ $appraisalApply->birthday_prefectures }}
                    </p>
                </div>
            </div>
        </span>
    </div>
</div>
