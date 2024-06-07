<dl class="C-form-block C-form-block--hope">
    <dt class="C-form-block__title C-form-block__title--req">製本の希望</dt>
    <dd class="C-form-block__body">
        <div class="C-form-block__radio">
            @include('components.form.original_radio', [
                'name'     => 'is_bookbinding',
                'class'    => 'C-form-block__radio__text',
                'data'     => App\Models\AppraisalApply::getBookbindingType(),
                'checked'  => $request->is_bookbinding ?? 1,
                'vModel'   => 'bookbindingClick',
                'onChange' => 'toggleCaluculateBookking',
            ])
        </div>
        <p class="Personal-appraisal__notice-text"><a href="https://hoshinomai.jp/book-service" target="_blank">製本の詳細はこちら</a></p>
    </dd>
</dl>
{{-- {{ str_contains(request()->path(), $item['prefix']) ? 'submenu-open' : '' }} --}}
<dl class="C-form-block C-form-block--hope" v-if="bookbindingClick == '1'">
    <dt class="C-form-block__title C-form-block__title--req">表紙のデザイン</dt>
    <dd class="C-form-block__body @if(str_contains(Request::url(), 'offer_appraisals')) offer_appraisals @endif">
        <div class="C-form-block__radio C-form-block__radio-pdf">
            @include('components.form.original_radio-pdf', [
                'name'     => 'is_design',
                'class'    => 'C-form-block__radio__text',
                'data'     => App\Models\AppraisalApply::PDF_TYPE,
                'checked'  => $request->is_design ?? 1,
            ])
        </div>
        <p class="Personal-appraisal__notice-text"><a href="https://hoshinomai.jp/book-service" target="_blank" rel="noopener noreferrer">製本の詳細はこちら</a></p>
    </dd>
</dl>
<!-- 製本に表示するお名前 -->
<dl class="C-form-block C-form-block--name" v-if="bookbindingClick == '1'">
    <dt class="C-form-block__title C-form-block__title--req">表紙に表示したいお名前をご記入ください</dt>
    <div style="display: flex;">
        <p class="C-form-block--password__text" style="width: 170px;">例：Mai Kaibe　/　山田 太郎</p>
        <p class="Personal-appraisal__notice-text">
            <a href="{{ route('user.download_images.download_sample_pdf') }}" style="position: relative; top: 0.6rem;">
                表紙イメージはこちら
            </a>
        </p>
    </div>
    <dd class="C-form-block__body">
        <div class="C-form-block__field" style="display: flex;">
            <label for="bookbinding_name1" style="width: 50px;">左側</label>
            @include('components.form.text', [
            'name' => 'bookbinding_name1',
            'placeholder' => 'Mai　/　山田',
            'value' => $data['bookbinding_name1'] ?? ''
            ])
        </div>
        @include('components.form.error', ['name' => 'bookbinding_name1','class' => 'text-danger'])
    </dd>
    <dd class="C-form-block__body">
        <div class="C-form-block__field" style="display: flex;">
            <label for="bookbinding_name2" style="width: 50px;">右側</label>
            @include('components.form.text', [
            'name' => 'bookbinding_name2',
            'placeholder' => 'Kaibe　/　太郎',
            'value' => $data['bookbinding_name2'] ?? ''
            ])
        </div>
        @include('components.form.error', ['name' => 'bookbinding_name2','class' => 'text-danger'])
    </dd>
</dl>
<dl class="C-form-block C-form-block--sending" v-if="bookbindingClick == '1'">
    <dt class="Personal-appraisal-sending__title">送付先を入力してください。</dt>
    <dd class="C-form-block__body">
        <dl class="C-form-block-child C-form-block--hasbutton C-form-block--zip">
            <dt class="C-form-block__title C-form-block__title--req">郵便番号</dt>
            <p class="C-form-block--password__text">※数字のみを入力してください</p>
            <dd class="C-form-block__body">
                <div class="C-form-block__field">
                    @include('components.form.text', [
                        'name'        => 'zip',
                        'placeholder' => '0123456',
                        'onKeyUp'     => 'AjaxZip3.zip2addr(this,\'\',\'address\',\'address\');',
                        'value'       => $request->zip ?? '',
                        'hyphenCheck' => true,
                    ])
                </div>
                @include('components.form.error', ['name' => 'zip','class' => 'text-danger'])
            </dd>
        </dl>
        <dl class="C-form-block-child C-form-block--address">
            <dt class="C-form-block__title C-form-block__title--req">住所</dt>
            <dd class="C-form-block__body">
                <div class="C-form-block__field">
                    @include('components.form.text', [
                        'name'          => 'address',
                        'placeholder'   => '長野県飯田市◯◯◯◯◯◯',
                        'value'         => $request->address ?? ''
                    ])
                </div>
                @include('components.form.error', ['name' => 'address','class' => 'text-danger'])
            </dd>
        </dl>
        <dl class="C-form-block-child C-form-block--building">
            <dt class="C-form-block__title">建物・マンション名</dt>
            <dd class="C-form-block__body">
                <div class="C-form-block__field">
                    @include('components.form.text', [
                        'name'        => 'building',
                        'placeholder' => '建物名 ◯◯号室',
                        'value'       => $request->building ?? ''
                    ])
                </div>
                @include('components.form.error', ['name' => 'building','class' => 'text-danger'])
            </dd>
        </dl>
        <dl class="C-form-block-child C-form-block--name">
            <dt class="C-form-block__title C-form-block__title--req">お名前</dt>
            <dd class="C-form-block__body">
                <div class="C-form-block__field">
                    @include('components.form.text', [
                        'name'        => 'building_name',
                        'placeholder' => '受け取り者様のお名前を入力してください',
                        'value'       => $request->building_name ?? '',
                        'autocomplete' => 'given-name'
                    ])
                </div>
                @include('components.form.error', ['name' => 'building_name','class' => 'text-danger'])
            </dd>
        </dl>
        <dl class="C-form-block-child C-form-block--tel">
            <dt class="C-form-block__title C-form-block__title--req">電話番号</dt>
            <p class="C-form-block--password__text">※数字のみを入力してください</p>
            <dd class="C-form-block__body">
                <div class="C-form-block__field">
                    @include('components.form.text', [
                        'name'        => 'tel',
                        'placeholder' => '01234567890',
                        'value'       => $request->tel ?? '',
                        'hyphenCheck' => true,
                    ])
                </div>
                @include('components.form.error', ['name' => 'tel','class' => 'text-danger'])
            </dd>
        </dl>
    </dd>
</dl>