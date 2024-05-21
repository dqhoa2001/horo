<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AspectPatternController\AspectPatternRequest;
use App\Repositories\AspectPatternRepository;
use App\Repositories\AspectRepository;
use App\Repositories\PlanetRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AspectPatternController extends Controller
{
    public function __construct(
        protected PlanetRepository $planetRepository,
        protected AspectRepository $aspectRepository,
        protected AspectPatternRepository $aspectPatternRepository,
    ) {}

    public function index(Request $request): View
    {
        $aspects = $this->aspectRepository->getAll();
        $planets = $this->planetRepository->getAll();

        $aspectId = $request->input('aspect_id');
        $fromPlanetId = $request->input('from_planet_id');
        $toPlanetId = $request->input('to_planet_id');
        $keyword = $request->input('keyword');

        $selectedValues = [
            'aspect_id' => $aspectId,
            'from_planet_id' => $fromPlanetId,
            'to_planet_id' => $toPlanetId,
            'keyword' => $keyword,
        ];

        if (!empty($aspectId) || !empty($fromPlanetId) || !empty($toPlanetId) || !empty($keyword)) {
            $aspectPatterns = $this->aspectPatternRepository->searchAspectPatterns($selectedValues);
        } else {
            $aspectPatterns = $this->aspectPatternRepository->getAllPaginate();
        }

        return view(
            'admin.pattern.aspect.index',
            compact(['aspects', 'planets', 'aspectPatterns', 'selectedValues'])
        );
    }

    public function view(?int $id = null): View
    {
        $aspects = $this->aspectRepository->getAll();
        $planets = $this->planetRepository->getAll();

        $aspectPattern = [];
        if (!empty($id)) {
            $aspectPattern = $this->aspectPatternRepository->find($id);
        }
        session(['url' => url()->previous()]);
        return view(
            'admin.pattern.aspect.view',
            compact(['aspects', 'planets', 'aspectPattern'])
        );
    }

    public function create(AspectPatternRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $aspectPattern = $this->aspectPatternRepository->create($data);
        $status = !empty($aspectPattern);
        $message = $status
            ? __('toast.create_success', ['model' => __('sidebar.aspect_pattern')])
            : __('toast.create_failed', ['model' => __('sidebar.aspect_pattern')]);
        return redirect()->route('admin.pattern.aspect-list')
            ->with('status', '作成しました');
        // return redirect()->route('admin.pattern.aspect-list')
        //     ->with('message', $message)->with('status', $status);
    }

    public function createBulk(AspectPatternRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $aspectPattern = $this->aspectPatternRepository->create($data);
        $message = !empty($aspectPattern)
            ? __('toast.create_success', ['model' => __('sidebar.aspect_pattern')])
            : __('toast.create_failed', ['model' => __('sidebar.aspect_pattern')]);
        return redirect()->route('admin.pattern.aspect-list')
            ->with('status', '作成しました');
        // return redirect()->route('admin.pattern.aspect-list')
        //     ->with('message', $message);
    }

    public function update(int $id, AspectPatternRequest $request): RedirectResponse
    {
        $dataUpdate = $request->validated();
        if (!isset($dataUpdate['content_en'])) {
            $dataUpdate['content_en'] = null;
        }
        $dataUpdate = $request->validated();
        if (!isset($dataUpdate['content_solar_en'])) {
            $dataUpdate['content_solar_en'] = null;
        }
        $updateStatus = $this->aspectPatternRepository->update($id, $dataUpdate);
        $message = $updateStatus
            ? __('toast.update_success', ['model' => __('sidebar.aspect_pattern')])
            : __('toast.update_failed', ['model' => __('sidebar.aspect_pattern')]);
        $previousUrl = session('url');
        return redirect($previousUrl)
            ->with('status', '更新しました');
        // return redirect($previousUrl)
        //     ->with('message', $message)->with('status', $updateStatus);
    }

    public function delete(int $id): RedirectResponse
    {
        $deleteStatus = $this->aspectPatternRepository->delete($id);
        $message = $deleteStatus
            ? __('toast.delete_success', ['model' => __('sidebar.aspect_pattern')])
            : __('toast.delete_failed', ['model' => __('sidebar.aspect_pattern')]);
        return redirect()->route('admin.pattern.aspect-list')
            ->with('status', '削除しました');
        // return redirect()->route('admin.pattern.aspect-list')
        //     ->with('message', $message)->with('status', $deleteStatus);
    }
}
