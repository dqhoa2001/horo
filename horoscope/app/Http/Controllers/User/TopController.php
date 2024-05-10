<?php

namespace App\Http\Controllers\User;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Repositories\HouseRepository;
use Illuminate\Http\RedirectResponse;
use App\Repositories\PlanetRepository;
use App\Repositories\ZodiacRepository;
use App\Services\AppraisalApplyService;
use Modules\Horoscope\Enums\WheelRadiusEnum;
use App\Repositories\SabianPatternRepository;
use App\Repositories\ZodiacPatternRepository;
use App\Http\Requests\User\TopController\PredictRequest;
use Modules\Horoscope\Http\Actions\Predict\ModifyLocation;
use Modules\Horoscope\Http\Actions\GenerateHoroscopeChartAction;
use Carbon\Carbon;

class TopController extends Controller
{
    public function __construct(
        protected GenerateHoroscopeChartAction $generateHoroscopeChartAction,
        protected ZodiacRepository $zodiacRepository,
        protected PlanetRepository $planetRepository,
        protected HouseRepository $houseRepository,
        protected ModifyLocation $modifyLocation,
        protected SabianPatternRepository $sabianPatternRepository,
        protected ZodiacPatternRepository $zodiacPatternRepository,
    ) {
    }

    public function top(): View
    {
        return view('user.mypage.index');
    }

    public function popUp(): View
    {
        return view('user.mypage.popup');
    }

    // LINEのポップアップ制御
    public function stopLinePopup(Request $request): JsonResponse
    {
        $user = auth()->guard('user')->user();
        $user->is_line_popup = false;
        $user->save();
        return response()->json(['success' => true]);
    }

    public function create(Request $request): View
    {
        return view('user.horoscope.create', [
            'request' => $request,
        ]);
    }

    public function predict(PredictRequest $request): View
    {
        // カーボンに変換
        $params = $request->substitutable();
        $birthday = \Carbon\Carbon::parse($params['birthday']);
        $birthdayTime = \Carbon\Carbon::parse($params['birthday_time']);

        $formData = array_merge($request->substitutable(), [
            'year' => $birthday->format('Y'),
            'month' => $birthday->format('m'),
            'day' => $birthday->format('d'),
            'hour' => $birthdayTime->format('H'),
            'minute' => $birthdayTime->format('i'),
            'birthday_time' => $birthdayTime,
            'birthday_prefectures' => $params['birthday_prefectures'],
        ]);

        // 経度・緯度を「東経 : 137 度 9 分」、「北緯 : 35 度 11 分」の形式に変換
        $location = $this->modifyLocation->execute((float) $formData['longitude'], (float) $formData['latitude']);

        $chart = $this->generateHoroscopeChartAction->execute($formData, WheelRadiusEnum::WheelScale);

        $zodiacs = $this->zodiacRepository->getAll();
        $planets = $this->planetRepository->getAll();
        $houses = $this->houseRepository->getAll();
        $image = $chart->get('image');
        $degreeData = $chart->get('degreeData');
        $explain = $chart->get('explain');
        $imgBase64 = base64_encode($image->getImageBlob());
        $horoscopeData = [
            'imgBase64'  => $imgBase64,
            'degreeData' => $degreeData,
            'explain'    => $explain,
            'formData'   => $formData,
            'zodiacs'    => $zodiacs,
            'planets'    => $planets,
            'houses'     => $houses,
            'location'   => $location,
        ];

        if ($params['background'] === 'normal') {
            return view('user.horoscope.complete1', $horoscopeData);
        }
        return view('user.horoscope.complete2', $horoscopeData);

    }

    // 入力修正へのリダイレクト(無料ホロスコープ作成画面へ)
    public function back(): RedirectResponse
    {
        return redirect()->route('user.horoscopes.create')->withInput();
    }
}
