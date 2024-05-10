<?php

namespace Modules\Horoscope\Http\Controllers;

use App\Repositories\HouseRepository;
use App\Repositories\PlanetRepository;
use App\Repositories\ZodiacRepository;
use App\Repositories\SabianPatternRepository;
use App\Repositories\ZodiacPatternRepository;
use Illuminate\Routing\Controller;
use Modules\Horoscope\Enums\WheelRadiusEnum;
use Modules\Horoscope\Enums\WheelColorEnum;
use Modules\Horoscope\Http\Actions\GenerateHoroscopeChartAction;
use Modules\Horoscope\Http\Requests\HoroscopeRequest;
use Modules\Horoscope\Http\Actions\Predict\ModifyLocation;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Str;

class HoroscopeController extends Controller
{
    function __construct(
        protected GenerateHoroscopeChartAction $generateHoroscopeChartAction,
        protected ZodiacRepository $zodiacRepository,
        protected PlanetRepository $planetRepository,
        protected HouseRepository $houseRepository,
        protected ModifyLocation $modifyLocation,
        protected SabianPatternRepository $sabianPatternRepository,
        protected ZodiacPatternRepository $zodiacPatternRepository,
    ) {
    }

    public function index()
    {
        return view('horoscope::index');
    }
    public function infor(HoroscopeRequest $request)
    {
        $formData = $request->all();
        return view('horoscope::infor', compact('formData'));
    }
    public function predict(HoroscopeRequest $request)
    {
        $formData = $request->validated();
        // dd($formData);
        $localtion = $this->modifyLocation->execute($formData['longitude'], $formData['latitude']);
        $chart = $this->generateHoroscopeChartAction
            ->execute($formData, WheelRadiusEnum::WheelScale);
        if (!$chart->get('status')) {
            return redirect()->route('horoscope-form')
                ->with('status', false)
                ->with('message', 'system error');
        }
        $zodiacColors = WheelColorEnum::ZodiacElement;
        $zodiacs = $this->zodiacRepository->getAll();
        $planets = $this->planetRepository->getAll();
        $houses = $this->houseRepository->getAll();
        $image = $chart->get('image');
        $degreeData = $chart->get('degreeData');
        $explain = $chart->get('explain');
        $imgBase64 = base64_encode($image->getImageBlob());
        return view(
            'horoscope::predict',
            compact([
                'imgBase64',
                'degreeData',
                'explain',
                'formData',
                'zodiacs',
                'planets',
                'houses',
                'localtion',
                'zodiacColors'
            ])
        );
    }

    public function preview(HoroscopeRequest $request)
    {
        $formData = $request->validated();
        // dd($formData);
        $chart = $this->generateHoroscopeChartAction
            ->execute($formData, WheelRadiusEnum::WheelScalePDF);
        if (!$chart->get('status')) {
            return redirect()->back()
                ->with('status', $chart->get('status'))
                ->with('message', 'system error');
        }

        $zodaics = $this->zodiacRepository->getAll();
        $planets = $this->planetRepository->getAll();
        $houses = $this->houseRepository->getAll();
        $sabian = $this->sabianPatternRepository->getAll();
        $zodaicsPattern = $this->zodiacPatternRepository->getAll();
        $degreeData = $chart->get('degreeData');
        $explain = $chart->get('explain');
        $image = $chart->get('image');
        $imgBase64 = base64_encode($image->getImageBlob());
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
            'zodaicsPattern' => $zodaicsPattern
        ];
        // $pdf = PDF::loadView('horoscope::preview', $data);
        // return $pdf->stream('myPDF.pdf');
        return view('horoscope::preview', $data);
    }

    public function download1(HoroscopeRequest $request)
    {
        $formData = $request->validated();
        $chart = $this->generateHoroscopeChartAction
            ->execute($formData, WheelRadiusEnum::WheelScalePDF);
        if (!$chart->get('status')) {
            return redirect()->back()
                ->with('status', $chart->get('status'))
                ->with('message', 'system error');
        }

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
        $fileName = Str::slug($formData['name']) . '-' . now()->format('Ymd-His') . '.pdf';
        $html = view('horoscope::dowload1', $data)->render();
        $pdfFilePath = public_path('/pdf/' . $fileName);
        $width_mm = (600 / 96) * 25.4;
        $height_mm = (840 / 96) * 25.4;
        Browsershot::html($html)
            ->timeout(600)
            ->paperSize($width_mm, $height_mm)
            ->newHeadless()
            ->noSandbox()
            ->showBackground()
            ->transparentBackground()
            ->waitUntilNetworkIdle()
            ->save($pdfFilePath);
        return response()->download($pdfFilePath, 'horoscope.pdf');
    }
    public function download2(HoroscopeRequest $request)
    {
        $formData = $request->validated();
        $chart = $this->generateHoroscopeChartAction
            ->execute($formData, WheelRadiusEnum::WheelScalePDF);
        if (!$chart->get('status')) {
            return redirect()->back()
                ->with('status', $chart->get('status'))
                ->with('message', 'system error');
        }

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
        $fileName = Str::slug($formData['name']) . '-' . now()->format('Ymd-His') . '.pdf';
        $html = view('horoscope::dowload2', $data)->render();
        $pdfFilePath = public_path('/pdf/' . $fileName);
        $width_mm = (600 / 96) * 25.4;
        $height_mm = (840 / 96) * 25.4;
        Browsershot::html($html)
            ->timeout(600)
            ->paperSize($width_mm, $height_mm)
            ->newHeadless()
            ->noSandbox()
            ->showBackground()
            ->transparentBackground()
            ->waitUntilNetworkIdle()
            ->save($pdfFilePath);
        return response()->download($pdfFilePath, 'horoscope.pdf');
    }
    public function download3(HoroscopeRequest $request)
    {
        $formData = $request->validated();
        $chart = $this->generateHoroscopeChartAction
            ->execute($formData, WheelRadiusEnum::WheelScalePDF);
        if (!$chart->get('status')) {
            return redirect()->back()
                ->with('status', $chart->get('status'))
                ->with('message', 'system error');
        }

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
        $fileName = Str::slug($formData['name']) . '-' . now()->format('Ymd-His') . '.pdf';
        $html = view('horoscope::dowload3', $data)->render();
        $pdfFilePath = public_path('/pdf/' . $fileName);
        $width_mm = (600 / 96) * 25.4;
        $height_mm = (840 / 96) * 25.4;
        Browsershot::html($html)
            ->timeout(600)
            ->paperSize($width_mm, $height_mm)
            ->newHeadless()
            ->noSandbox()
            ->showBackground()
            ->transparentBackground()
            ->waitUntilNetworkIdle()
            ->save($pdfFilePath);
        return response()->download($pdfFilePath, 'horoscope.pdf');
    }
}
