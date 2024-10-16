<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\AppraisalApply;
use App\Models\BookbindingUserApply;
use Spatie\Browsershot\Browsershot;
use App\Repositories\HouseRepository;
use App\Repositories\PlanetRepository;
use App\Repositories\ZodiacRepository;
use Modules\Horoscope\Enums\ExplainEnum;
use Modules\Horoscope\Enums\WheelColorEnum;
use Modules\Horoscope\Enums\WheelRadiusEnum;
use App\Repositories\SabianPatternRepository;
use App\Repositories\ZodiacPatternRepository;
use Modules\Horoscope\Http\Actions\Predict\ModifyLocation;
use Modules\Horoscope\Http\Actions\GenerateHoroscopeChartAction;

class AppraisalApplyService
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

    //支払い履歴の登録処理
    public static function create(Request $request, string $referenceType, int $referenceId): AppraisalApply
    {
        $appraisalApply = AppraisalApply::create([
            'reference_type' => $referenceType,
            'reference_id' => $referenceId,
            'birthday' => $request->birthday,
            'birthday_prefectures' => $request->birthday_prefectures,
            'birthday_city' => $request->birthday_city ?? null,
            'birthday_time' => $request->birthday_time,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
            'timezome' => $request->timezone,
        ]);

        return $appraisalApply;
    }

    // 鑑定結果データの作成
    public function createAppraisalResultData(AppraisalApply $appraisalApply): array
    {
        $formData = [
            "name" => auth()->guard('user')->user()->name1 . auth()->guard('user')->user()->name2,
            "year" => $appraisalApply->birthday->format('Y'),
            "month" => $appraisalApply->birthday->format('m'),
            "day" => $appraisalApply->birthday->format('d'),
            "hour" => $appraisalApply->birthday_time->format('H'),
            "minute" => $appraisalApply->birthday_time->format('i'),
            "longitude" => $appraisalApply->longitude,
            "latitude" => $appraisalApply->latitude,
            "map-city" => $appraisalApply->birthday_prefectures,
            "timezone" => $appraisalApply->timezome, //海外展開時にはここが変更できるようにする。現在は日本のみ
            "background" => 'normal', //仮
        ];

        // ホロスコープ占いの処理
        $chart = $this->generateHoroscopeChartAction->execute($formData, WheelRadiusEnum::WheelScale);
        $zodaics = $this->zodiacRepository->getAll();
        $planets = $this->planetRepository->getAll();
        $houses = $this->houseRepository->getAll();
        $degreeData = $chart->get('degreeData');
        $explain = $chart->get('explain');
        $zodaicsPattern = $this->zodiacPatternRepository->getAll();
        $sabian = $this->sabianPatternRepository->getAll();

        foreach ($explain as $key => $item) {
            //$removePlanetの中に$keyがあるかどうかを判定し、あれば削除する
            if (\in_array($key, ExplainEnum::removePlanet, true)) {
                unset($explain[$key]);
            }
        }
        $sortPlanet = ExplainEnum::sortPlanet;
        $explain = \Arr::sort($explain, static function ($value, $key) use ($sortPlanet) {
            return array_search($key, $sortPlanet, true);
        });

        $appraisalResultData = [
            'zodaics' => $zodaics,
            'planets' => $planets,
            'houses' => $houses,
            'degreeData' => $degreeData,
            'explain' => $explain,
            'zodaicsPattern' => $zodaicsPattern,
            'sabian' => $sabian,
        ];

        return $appraisalResultData;
    }

    // 製本の作成
    public function makeBook(BookbindingUserApply $bookbindingUserApply): array
    {
        \Log::info('makeBookメソッド' , [
            'id' => $bookbindingUserApply->id,
        ]);
        $appraisalApply = $bookbindingUserApply->appraisalApply;
        $bookbindingName = $bookbindingUserApply->bookbinding_name1 . ' ' . $bookbindingUserApply->bookbinding_name2;
        if ($bookbindingUserApply->bookbinding_name1 === null && $bookbindingUserApply->bookbinding_name2 === null) {
            $bookbindingName = $appraisalApply->reference->name1 . $appraisalApply->reference->name2;
        }
        $formData = [
            "name" => $appraisalApply->reference->name1 . $appraisalApply->reference->name2,
            "bookbinding_name" => $bookbindingName,
            "year" => $appraisalApply->birthday->format('Y'),
            "month" => $appraisalApply->birthday->format('m'),
            "day" => $appraisalApply->birthday->format('d'),
            "hour" => $appraisalApply->birthday_time->format('H'),
            "minute" => $appraisalApply->birthday_time->format('i'),
            "longitude" => $appraisalApply->longitude,
            "latitude" => $appraisalApply->latitude,
            "map-city" => $appraisalApply->birthday_prefectures,
            "timezone" => $appraisalApply->timezome, //海外展開時にはここが変更できるようにする。現在は日本のみ
            "background" => 'normal', //仮
            "relationship" => 'nullable', // 仮
        ];

        // ホロスコープ占いの処理
        $chart = $this->generateHoroscopeChartAction->execute($formData, WheelRadiusEnum::WheelScale);
        $zodaics = $this->zodiacRepository->getAll();
        $planets = $this->planetRepository->getAll();
        $houses = $this->houseRepository->getAll();
        $sabian = $this->sabianPatternRepository->getAll();
        $zodaicsPattern = $this->zodiacPatternRepository->getAll();
        $degreeData = $chart->get('degreeData');
        $explain = $chart->get('explain');
        $image = $chart->get('image');
        $imgBase64 = base64_encode($image->getImageBlob());
        $zodiacColors = WheelColorEnum::ZodiacElement;
        $dayCreate = date("Y.m.d");
        $data = [
            'formData' => $formData,
            'title' => 'chart result',
            'image' => $imgBase64,
            'degreeData' => $degreeData,
            'explain' => $explain,
            'zodaics' => $zodaics,
            'planets' => $planets,
            'houses' => $houses,
            'sabian' => $sabian,
            'zodaicsPattern' => $zodaicsPattern,
            'zodiacColors' => $zodiacColors,
            'dayCreate' => $dayCreate,
        ];
        $fileName = $formData['name'] . '_' . now()->format('Ymd-His') . '.pdf';
        
        $designType = $bookbindingUserApply->is_design;        
        $blade = '';
        if ((int) $designType === AppraisalApply::PDF_SOPHIA) {
            $blade = view('horoscope::dowload1', $data);
        }
        if ((int) $designType === AppraisalApply::PDF_KLEOS) {
            $blade = view('horoscope::dowload2', $data);
        }
        if ((int) $designType === AppraisalApply::PDF_DYNAMIS) {
            $blade = view('horoscope::dowload3', $data);
        }
        $html = $blade->render();
        
        $pdfFilePath = public_path('/pdfs/' . $fileName);
        // $width_mm = (600 / 96) * 25.4; // 158.75
        // $height_mm = (840 / 96) * 25.4; // 222.25
        // $width_mm = 216; // 新サイズ
        // $height_mm = 305; // 新サイズ
        // $width_in = 8.5;
        // $height_in = 11.9;
        Browsershot::html($html)
            ->timeout(600)
            // ->paperSize($width_mm, $height_mm)
            ->margins(0, 0, 0, 0) // 上下左右の余白をゼロに設定
            ->format('A4')
            // ->scale(1.03)
            ->newHeadless()
            ->noSandbox()
            ->showBackground()
            ->transparentBackground()
            ->waitUntilNetworkIdle()
            ->save($pdfFilePath);
        
        \Log::info('PDFファイル作成', [
            'pdfFilePath' => $pdfFilePath,
            'fileName' => $fileName,
        ]);

        $pdfData = [
            'pdfFilePath' => $pdfFilePath,
            'fileName' => $fileName,
        ];

        return $pdfData;
    }

    // 表紙イメージの作成
    public function makeCoverImage(int $design, string $name1, string $name2): array
    {
        \Log::debug('makeCoverImage' , [
            'design' => $design,
            'name1' => $name1,
            'name2' => $name2,
        ]);
        $bookbindingName = $name1 . ' ' . $name2;
        $formData = [
            "bookbinding_name" => $bookbindingName,
        ];
        $data = [
            'formData' => $formData,
        ];
        $fileName = $design . '_' . $name1 . $name2 . '_sample_cover_' . now()->format('Ymd-His') . '.pdf';
        
        $blade = '';
        if ((int) $design === AppraisalApply::PDF_SOPHIA) {
            $blade = view('horoscope::cover1', $data);
        }
        if ((int) $design === AppraisalApply::PDF_KLEOS) {
            $blade = view('horoscope::cover2', $data);
        }
        if ((int) $design === AppraisalApply::PDF_DYNAMIS) {
            $blade = view('horoscope::cover3', $data);
        }
        $html = $blade->render();
        
        $pdfFilePath = public_path('/pdfs/' . $fileName);
        Browsershot::html($html)
            ->timeout(600)
            ->margins(0, 0, 0, 0) // 上下左右の余白をゼロに設定
            ->format('A4')
            ->newHeadless()
            ->noSandbox()
            ->showBackground()
            ->transparentBackground()
            ->waitUntilNetworkIdle()
            ->save($pdfFilePath);
        
        \Log::info('PDFファイル作成', [
            'pdfFilePath' => $pdfFilePath,
            'fileName' => $fileName,
        ]);

        $pdfData = [
            'pdfFilePath' => $pdfFilePath,
            'fileName' => $fileName,
        ];

        return $pdfData;
    }
}
