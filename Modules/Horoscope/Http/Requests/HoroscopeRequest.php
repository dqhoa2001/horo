<?php

namespace Modules\Horoscope\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Modules\Horoscope\Rules\DayOfMonthValid;
use Modules\Horoscope\Rules\TimeZoneValid;
class HoroscopeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        // dd($this->all());
        return [
            'name' => 'required',
            'year' => [
                'required',
                'integer',
                'between:1900,2099',
            ],
            'month' => [
                'required',
                'numeric',
                'between:1,12',
            ],
            'day' => [
                'required',
                'numeric',
                'between:1,31',
                new DayOfMonthValid($this->all()),
            ],
            'hour' => 'required|numeric|between:0,23',
            'minute' => 'required|numeric|between:0,59',
            'longitude' => 'required|numeric|between:-179.99,179.99',
            'latitude' => 'required|numeric|between:-65.99,65.99',
            'map-city' => '',
            'timezone' => [
                'required',
                new TimeZoneValid($this->all()),
            ],
            'background' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => '名前を入力してください',
            'year.required' => '年を入力してください',
            'year.integer' => '年は半角の数字を入力してください',
            'year.between' => '年は1900から2099の間で指定してください',
            'month.required' => '月を入力してください。',
            'month.numeric' => '月は半角の数字を入力してください',
            'month.between' => '月は1から12の間で指定してください',
            'day.required' => '日を入力してください',
            'day.numeric' => '日は半角の数字を入力してください',
            'day.between' => '正しい日を入力してください',
            'day.custom' => '正しい日を入力してください',
            'hour.required' => '時を入力してください',
            'hour.numeric' => '時は半角の数字を入力してください',
            'hour.between' => '時は0から23の間で指定してください',
            'minute.required' => '分を入力してください。',
            'minute.numeric' => '分は半角の数字を入力してください',
            'minute.between' => '分は0から59の間で指定してください',
            'longitude.required' => '経度を入力してください',
            'longitude.numeric' => '経度は半角の数字を入力してください',
            'longitude.between' => '経度は-179.99から179.99の間で指定してください',
            'latitude.required' => '緯度を入力してください',
            'latitude.numeric' => '緯度は半角の数字を入力してください',
            'latitude.between' => '緯度は-65.99から65.99の間で指定してください',
            'timezone.required' => 'タイムゾーンを選択してください',
            'background.required' => '背景を選択してください',
        ];
    }
}