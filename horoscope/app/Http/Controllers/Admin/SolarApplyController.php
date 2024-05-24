<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\SolarApply;
use Spatie\Browsershot\Browsershot;
use App\Http\Controllers\Controller;
use App\Repositories\HouseRepository;
use Illuminate\Http\RedirectResponse;
use App\Repositories\PlanetRepository;
use App\Repositories\ZodiacRepository;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Modules\Horoscope\Enums\ExplainEnum;
use Modules\Horoscope\Enums\WheelColorEnum;
use Modules\Horoscope\Enums\WheelRadiusEnum;
use App\Repositories\SabianPatternRepository;
use App\Repositories\ZodiacPatternRepository;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Modules\Horoscope\Http\Actions\Predict\ModifyLocation;
use Modules\Horoscope\Http\Actions\GenerateHoroscopeChartAction;
use App\Http\Requests\Admin\SolarApplyController\UpdateRequest;
use App\Models\BookbindingUserApply;
use App\Services\SolarApplyService;
use Session;

class SolarApplyController extends Controller
{
    public function __construct(
        protected GenerateHoroscopeChartAction $generateHoroscopeChartAction,
        protected ZodiacRepository $zodiacRepository,
        protected PlanetRepository $planetRepository,
        protected HouseRepository $houseRepository,
        protected ModifyLocation $modifyLocation,
        protected SabianPatternRepository $sabianPatternRepository,
        protected ZodiacPatternRepository $zodiacPatternRepository,
        protected SolarApplyService $solarApplyService,
    ) {}

    // 鑑定編集
    public function edit(SolarApply $solarApply): View
    {
        return view('admin.solar_applies.edit', [
            'solarApply' => $solarApply,
        ]);
    }

    // 鑑定更新
    public function update(UpdateRequest $request, SolarApply $solarApply): RedirectResponse
    {
            //  dd($request->all());
        $solarApply->update($request->substitutable());

        $solarApply->reference()->update($request->substitutable());

        return back()->with('status', '更新しました');

    }

    // 会員編集画面にリダイレクト
    public function redirectUsersEdit(SolarApply $solarApply): RedirectResponse
    {
        $user = $solarApply->reference;

        if ($solarApply->reference instanceof \App\Models\Family) {
            $user = $solarApply->reference->user;
        }
        return to_route('admin.users.edit', $user);
    }

    // 鑑定ダウンロード
    public function downloadPdf(BookbindingUserApply $bookbindingUserApply): BinaryFileResponse
    {
        $pdfData = $this->solarApplyService->makeBook($bookbindingUserApply);

        return response()->download($pdfData['pdfFilePath'], $pdfData['fileName']);
    }

    // 鑑定ダウンロード(ローカル検証用)
    // public function downloadPdf(BookbindingUserApply $bookbindingUserApply)
    // {
    //     // $pdfData = $this->SolarApplyService->makeBook($bookbindingUserApply);

    //     $solarApply = $bookbindingUserApply->SolarApply;
    //     $bookbindingName = $bookbindingUserApply->bookbinding_name1 . ' ' . $bookbindingUserApply->bookbinding_name2;
    //     if ($bookbindingUserApply->bookbinding_name1 === null && $bookbindingUserApply->bookbinding_name2 === null) {
    //         $bookbindingName = $solarApply->reference->name1 . $solarApply->reference->name2;
    //     }
    //     $formData = [
    //         "name" => $solarApply->reference->name1 . $solarApply->reference->name2,
    //         "bookbinding_name" => $bookbindingName,
    //         "year" => $solarApply->birthday->format('Y'),
    //         "month" => $solarApply->birthday->format('m'),
    //         "day" => $solarApply->birthday->format('d'),
    //         "hour" => $solarApply->birthday_time->format('H'),
    //         "minute" => $solarApply->birthday_time->format('i'),
    //         "longitude" => $solarApply->longitude,
    //         "latitude" => $solarApply->latitude,
    //         "map-city" => $solarApply->birthday_city,
    //         "timezone" => $solarApply->timezome, //海外展開時にはここが変更できるようにする。現在は日本のみ
    //         "background" => 'normal', //仮
    //         "relationship" => 'nullable', // 仮
    //     ];

    //     // ホロスコープ占いの処理
    //     $chart = $this->generateHoroscopeChartAction->execute($formData, WheelRadiusEnum::WheelScale);
    //     $zodaics = $this->zodiacRepository->getAll();
    //     $planets = $this->planetRepository->getAll();
    //     $houses = $this->houseRepository->getAll();
    //     $sabian = $this->sabianPatternRepository->getAll();
    //     $zodaicsPattern = $this->zodiacPatternRepository->getAll();
    //     $degreeData = $chart->get('degreeData');
    //     $explain = $chart->get('explain');
    //     $image = $chart->get('image');
    //     $imgBase64 = base64_encode($image->getImageBlob());
    //     $zodiacColors = WheelColorEnum::ZodiacElement;
    //     $dayCreate = date("Y.m.d");
    //     $data = [
    //         'formData' => $formData,
    //         'title' => 'chart result',
    //         'image' => $imgBase64,
    //         'degreeData' => $degreeData,
    //         'explain' => $explain,
    //         'zodaics' => $zodaics,
    //         'planets' => $planets,
    //         'houses' => $houses,
    //         'sabian' => $sabian,
    //         'zodaicsPattern' => $zodaicsPattern,
    //         'zodiacColors' => $zodiacColors,
    //         'dayCreate' => $dayCreate,
    //     ];

    //     return view('horoscope::dowload1', $data);

    //     // return response()->download($pdfData['pdfFilePath'], $pdfData['fileName']);
    // }
}
