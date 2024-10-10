<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ZodiacPatternController\ZodiacPatternRequest;
use App\Repositories\PlanetRepository;
use App\Repositories\ZodiacRepository;
use Illuminate\Http\Request;
use App\Repositories\ZodiacPatternRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ZodiacPatternController extends Controller
{
    public function __construct(
        protected ZodiacRepository $zodiacRepository,
        protected PlanetRepository $planetRepository,
        protected ZodiacPatternRepository $zodiacPatternRepository,
    ) {
    }

    function index(Request $request): View
    {
        $planets = $this->planetRepository->getAll();
        $zodiacs = $this->zodiacRepository->getAll();

        $zodiacId = $request->input('zodiac_id');
        $planetId = $request->input('planet_id');
        $keyword = $request->input('keyword');

        $selectedValues = [
            'zodiac_id' => $zodiacId,
            'planet_id' => $planetId,
            'keyword' => $keyword,
        ];
        if (!empty($zodiacId) || !empty($planetId) || !empty($keyword) ) {
            $zodiacPatterns = $this->zodiacPatternRepository->searchZodiacPatterns($selectedValues);
        } else {    
            $zodiacPatterns = $this->zodiacPatternRepository->getAllPaginate();
        }
       
        return view(
            'admin.pattern.zodiac.index',
            compact(['planets', 'zodiacs', 'selectedValues', 'zodiacPatterns'])
        );
    }

    function view(?int $id = null): View
    {
        session(['url' => url()->previous()]);
        $zodiacs = $this->zodiacRepository->getAll();
        $planets = $this->planetRepository->getAll();
        $zodiacPattern = [];

        if (!empty($id)) {
            $zodiacPattern = $this->zodiacPatternRepository->find($id);
        }

        return view(
            'admin.pattern.zodiac.view',
            compact(['planets', 'zodiacs', 'zodiacPattern'])
        );
    }

    function create(ZodiacPatternRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $zodiacPattern = $this->zodiacPatternRepository->create($data);
        $status = !empty($zodiacPattern);
        $message = $status
            ? __('toast.create_success', ['model' => __('sidebar.zodiac_pattern')])
            : __('toast.create_failed', ['model' => __('sidebar.zodiac_pattern')]);
        return redirect()->route('admin.pattern.zodiac-list')
            ->with('status', '作成しました');
        // return redirect()->route('admin.pattern.zodiac-list')
        //     ->with('message', $message)->with('status', $status);
    }

    // ZodiacPatternBulkRequestが存在しないため、一時的にコメントアウト
    // function createBulk(ZodiacPatternBulkRequest $request): RedirectResponse
    // {
    //     $data = $request->validated();
    //     $zodiacPattern = $this->zodiacPatternRepository->create($data);
    //     $message = !empty($zodiacPattern) ? 'create success' : 'create failed';
    //     return redirect()->route('admin.pattern.zodiac-list')
    //         ->with('message', $message);
    // }

    function update(int $id, ZodiacPatternRequest $request): RedirectResponse
    {
        $dataUpdate = $request->validated();
        if (!isset($dataUpdate['content_en'])) {
            $dataUpdate['content_en'] = null;
        }
        if (!isset($dataUpdate['content_solar_en'])) {
            $dataUpdate['content_solar_en'] = null;
        }
        $updateStatus = $this->zodiacPatternRepository->update($id, $dataUpdate);
        $message = $updateStatus
            ? __('toast.update_success', ['model' => __('sidebar.zodiac_pattern')])
            : __('toast.update_failed', ['model' => __('sidebar.zodiac_pattern')]);
            $previousUrl = session('url');
            return redirect($previousUrl)
                ->with('status', '更新しました');
            // return redirect($previousUrl)
            //     ->with('message', $message)->with('status', $updateStatus);
    }

    function delete(int $id): RedirectResponse
    {
        $deleteStatus = $this->zodiacPatternRepository->delete($id);
        $message = $deleteStatus
            ? __('toast.delete_success', ['model' => __('sidebar.zodiac_pattern')])
            : __('toast.delete_failed', ['model' => __('sidebar.zodiac_pattern')]);
        return redirect()->route('admin.pattern.zodiac-list')
            ->with('status', '削除しました');
        // return redirect()->route('admin.pattern.zodiac-list')
        //     ->with('message', $message)->with('status', $deleteStatus);
    }
}