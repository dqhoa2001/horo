
<div class="C-user-list">
    <div class="C-user-list-block">
        <span class="C-user-list-block__inner C-user-list-block__hasimage">
            <figure class="C-user-list-block__image"><img
                    src="{{ asset('mypage/assets/images/solar-return/img_thumbnail.svg') }}" alt="画像"></figure>
            <div class="C-user-list-block__hasimage__inner">
                <h3 class="C-user-list-block__title" data-tag="Name"><span>{{ auth()->guard('user')->user()->name1 }}　{{ auth()->guard('user')->user()->name2 }}</span>さん</h3>
                    <div class="C-user-list-block__content">
                        <!-- <p class="C-user-list-block__item" data-tag="Solar Year">{{ $solarDate->format('Y') }}</p>
                        <p class="C-user-list-block__item" data-tag="Solar Time">{{ $solarDate->format('H : i') }}</p>
                        <p class="C-user-list-block__item" data-tag="Location">{{ auth()->guard('user')->user()->birthday_prefectures }}</p> -->
                        <p class="C-user-list-block__item" data-tag="Birthday">
                        {{ $birthday->format('Y-m-d') }}
                        </p>
                        <p class="C-user-list-block__item" data-tag="Birth Time">
                            {{ $birthday_time->format('H:i') }}
                        </p>
                        <p class="C-user-list-block__item" data-tag="Location">
                            {{ $birthday_prefectures }}
                        </p>
                    </div>
            </div>
        </span>
    </div>
</div>
