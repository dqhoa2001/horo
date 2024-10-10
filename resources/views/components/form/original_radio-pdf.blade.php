{{--
使い方
・dataにはeloquentコレクションか配列か連想配列を指定可能
・eloquentコレクション使用時はkeyとvalueにカラム名を指定
・selectedには選択状態にしたいoptionのvalueを指定する
・defaultには未選択状態の時の表示文字を入れる。例）default="未選択"
@include('components.form.radio', ['name' => '', 'data' => (array)[$v]])-
--}}
@isset($solar)
@foreach($data as $k => $v)
        <label class="C-form-block__radio-pdf__item @error($name) is-invalid @enderror">
            {{-- <span class="C-form-block__radio-pdf-title C-form-block__radio-pdf-title{{ '4' }}"></span> --}}
            <input class="form-check-input"
                type="radio"
                name="{{ $name }}"
                id="{{ $name . '4' }}"
                value="{{ $k }}"
                @isset($checked)
                    @if(old($name, $checked) == $k) checked @elseif('4' == 4 && empty($noChecked)) checked @endif
                @else
                    @if(old($name) == $k) checked @elseif('4' == 4 && empty($noChecked)) checked @endif
                @endisset
                @isset($vModel)
                    v-model="{{ $vModel }}"
                @endisset
                @isset($onChange)
                    @change="{{ $onChange }}"
                @endisset
            >
            <span class="C-form-block__radio-pdf-sr__text" for="{{ $name . '4' }}">
                {{-- <img src="{{ asset('images/common/pdf') }}{{ '4' }}.svg" alt=""> --}}
                {{-- <img src="{{ asset('images/common/pdf') }}{{ '4' }}.png" alt=""> --}}
                <img src="{{ asset('images/common/solarreturn.png') }}" alt="">
            </span>
        </label>
    @endforeach
@else
    @foreach($data as $k => $v)
        <label class="C-form-block__radio-pdf__item @error($name) is-invalid @enderror">
            <span class="C-form-block__radio-pdf-title C-form-block__radio-pdf-title{{ $loop->iteration }}"></span>
            <input class="form-check-input"
                type="radio"
                name="{{ $name }}"
                id="{{ $name . $loop->iteration }}"
                value="{{ $k }}"
                @isset($checked)
                    @if(old($name, $checked) == $k) checked @elseif($loop->iteration == 1 && empty($noChecked)) checked @endif
                @else
                    @if(old($name) == $k) checked @elseif($loop->iteration == 1 && empty($noChecked)) checked @endif
                @endisset
                @isset($vModel)
                    v-model="{{ $vModel }}"
                @endisset
                @isset($onChange)
                    @change="{{ $onChange }}"
                @endisset
            >
            <span class="C-form-block__radio-pdf__text" for="{{ $name . $loop->iteration }}">
                <img src="{{ asset('images/common/pdf') }}{{ $loop->iteration }}.svg" alt="">
            </span>
        </label>
    @endforeach
@endisset

