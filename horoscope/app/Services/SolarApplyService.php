<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\SolarApply;
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
use Modules\Horoscope\Http\Actions\GenerateSolarHoroscopeChartAction;
use App\Models\SolarBookbindingUserApply;

class SolarApplyService
{
    public function __construct(
        protected GenerateHoroscopeChartAction $generateHoroscopeChartAction,
        protected GenerateSolarHoroscopeChartAction $generateSolarHoroscopeChartAction,
        protected ZodiacRepository $zodiacRepository,
        protected PlanetRepository $planetRepository,
        protected HouseRepository $houseRepository,
        protected ModifyLocation $modifyLocation,
        protected SabianPatternRepository $sabianPatternRepository,
        protected ZodiacPatternRepository $zodiacPatternRepository,
    ) {
    }

    //支払い履歴の登録処理
    public static function create(Request $request, string $referenceType, int $referenceId): SolarApply
    {
        $solarApply = SolarApply::create([
            'reference_type' => $referenceType,
            'reference_id' => $referenceId,
            'solar_date' => $request->solar_date,
        ]);

        return $solarApply;
    }

    // 鑑定結果データの作成
    public function createSolarResultData(SolarApply $solarApply): array
    {
        $formData = [
            "name" => auth()->guard('user')->user()->name1 . auth()->guard('user')->user()->name2,
            "year" => $solarApply->solar_date->format('Y'),
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

        $solarResultData = [
            'zodaics' => $zodaics,
            'planets' => $planets,
            'houses' => $houses,
            'degreeData' => $degreeData,
            'explain' => $explain,
            'zodaicsPattern' => $zodaicsPattern,
            'sabian' => $sabian,
        ];

        return $solarResultData;
    }

    // 製本の作成
    public function makeBook(SolarBookbindingUserApply $solarBookbindingUserApply): array
    {
        \Log::info('makeSolarBookメソッド' , [
            'id' => $solarBookbindingUserApply->id,
        ]);
        $solarApply = $solarBookbindingUserApply->solarApply;
        $bookbindingName = $solarBookbindingUserApply->bookbinding_name1 . ' ' . $solarBookbindingUserApply->bookbinding_name2;
        // dd($bookbindingName);
        if ($solarBookbindingUserApply->bookbinding_name1 === null && $solarBookbindingUserApply->bookbinding_name2 === null) {
            $bookbindingName = $solarApply->reference->name1 . $solarApply->reference->name2;
        }
        $formData = [
            "name" => $solarApply->reference->name1 . $solarApply->reference->name2,
            "bookbinding_name" => $bookbindingName,
            // "year" => $solarApply->birthday->format('Y'),
            "year"  => $solarApply->solar_date,
            "month" => $solarApply->reference->birthday->format('m'),
            "day" => $solarApply->reference->birthday->format('d'),
            "hour" => $solarApply->reference->birthday_time->format('H'),
            "minute" => $solarApply->reference->birthday_time->format('i'),
            "longitude" => $solarApply->reference->longitude,
            "latitude" => $solarApply->reference->latitude,
            "map-city" => $solarApply->reference->birthday_prefectures,
            "timezone" => $solarApply->timezome, //海外展開時にはここが変更できるようにする。現在は日本のみ
            "background" => 'normal', //仮
            "relationship" => 'nullable', // 仮
        ];

        // ホロスコープ占いの処理
        $chart = $this->generateSolarHoroscopeChartAction->execute($formData, WheelRadiusEnum::WheelScale);
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

        $designType = $solarBookbindingUserApply->is_design;
        $blade = '';
        if ((int) $designType === SolarApply::PDF_SOPHIA) {
            $blade = view('horoscope::dowload1', $data);
        }
        if ((int) $designType === SolarApply::PDF_KLEOS) {
            $blade = view('horoscope::dowload2', $data);
        }
        if ((int) $designType === SolarApply::PDF_DYNAMIS) {
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
        if ((int) $design === SolarApply::PDF_SOPHIA) {
            $blade = view('horoscope::cover1', $data);
        }
        if ((int) $design === SolarApply::PDF_KLEOS) {
            $blade = view('horoscope::cover2', $data);
        }
        if ((int) $design === SolarApply::PDF_DYNAMIS) {
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
