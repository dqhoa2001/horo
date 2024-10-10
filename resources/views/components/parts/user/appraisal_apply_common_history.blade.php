<div class="C-appraisal-history">
    <h3 class="C-appraisal-history__title"><span>{{ $name }}鑑定履歴</span></h3>
    <div class="C-appraisal-history__inner">
        @foreach ($appraisalApplies as $appraisalApply)
        <div class="C-appraisal-history-block">
            <a href="{{ route($route, $appraisalApply) }}">
                <time class="C-appraisal-history-block__time" datetime="{{ $appraisalApply->birthday->format('Y.m.d') }}">
                {{ $appraisalApply->birthday->format('Y.m.d') }}
                    </time>
                <p class="C-appraisal-history-block__title">
                    {{ $appraisalApply->reference->name1 }} {{ $appraisalApply->reference->name2 }}さんの個人鑑定
                </p>
            </a>
        </div>
        @endforeach
    </div>
</div>
