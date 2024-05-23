<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\AppraisalApply;
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
use App\Http\Requests\Admin\AppraisalApplyController\UpdateRequest;
use App\Models\BookbindingUserApply;
use App\Services\AppraisalApplyService;

class AppraisalApplyController extends Controller
{
    public function __construct(
        protected GenerateHoroscopeChartAction $generateHoroscopeChartAction,
        protected ZodiacRepository $zodiacRepository,
        protected PlanetRepository $planetRepository,
        protected HouseRepository $houseRepository,
        protected ModifyLocation $modifyLocation,
        protected SabianPatternRepository $sabianPatternRepository,
        protected ZodiacPatternRepository $zodiacPatternRepository,
        protected AppraisalApplyService $appraisalApplyService,
    ) {}

    // 鑑定編集
    public function edit(AppraisalApply $appraisalApply): View
    {
        // dd($appraisalApply);
        return view('admin.appraisal_applies.edit', [
            'appraisalApply' => $appraisalApply,
        ]);
    }

    // 鑑定更新
    public function update(UpdateRequest $request, AppraisalApply $appraisalApply): RedirectResponse
    {
        $appraisalApply->update($request->substitutable());

        $appraisalApply->reference()->update($request->substitutable());

        return back()->with('status', '更新しました');
    }

    // 会員編集画面にリダイレクト
    public function redirectUsersEdit(AppraisalApply $appraisalApply): RedirectResponse
    {
        $user = $appraisalApply->reference;

        if ($appraisalApply->reference instanceof \App\Models\Family) {
            $user = $appraisalApply->reference->user;
        }
        return to_route('admin.users.edit', $user);
    }

    // 鑑定ダウンロード
    public function downloadPdf(BookbindingUserApply $bookbindingUserApply): BinaryFileResponse
    {
        $pdfData = $this->appraisalApplyService->makeBook($bookbindingUserApply);

        return response()->download($pdfData['pdfFilePath'], $pdfData['fileName']);
    }

    // 鑑定ダウンロード(ローカル検証用)
    // public function downloadPdf(BookbindingUserApply $bookbindingUserApply)
    // {
    //     // $pdfData = $this->appraisalApplyService->makeBook($bookbindingUserApply);

    //     $appraisalApply = $bookbindingUserApply->appraisalApply;
    //     $bookbindingName = $bookbindingUserApply->bookbinding_name1 . ' ' . $bookbindingUserApply->bookbinding_name2;
    //     if ($bookbindingUserApply->bookbinding_name1 === null && $bookbindingUserApply->bookbinding_name2 === null) {
    //         $bookbindingName = $appraisalApply->reference->name1 . $appraisalApply->reference->name2;
    //     }
    //     $formData = [
    //         "name" => $appraisalApply->reference->name1 . $appraisalApply->reference->name2,
    //         "bookbinding_name" => $bookbindingName,
    //         "year" => $appraisalApply->birthday->format('Y'),
    //         "month" => $appraisalApply->birthday->format('m'),
    //         "day" => $appraisalApply->birthday->format('d'),
    //         "hour" => $appraisalApply->birthday_time->format('H'),
    //         "minute" => $appraisalApply->birthday_time->format('i'),
    //         "longitude" => $appraisalApply->longitude,
    //         "latitude" => $appraisalApply->latitude,
    //         "map-city" => $appraisalApply->birthday_city,
    //         "timezone" => $appraisalApply->timezome, //海外展開時にはここが変更できるようにする。現在は日本のみ
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
