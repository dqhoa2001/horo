<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\PlanetPattern;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Repositories\ZodiacRepository;
use App\Repositories\SabianPatternRepository;
use App\Http\Requests\Admin\SabianPatternController\SabianPatternRequest;

class SabianPatternController extends Controller
{
    public function __construct(
        protected SabianPatternRepository $sabianPatternRepository,
        protected ZodiacRepository $zodiacRepository
    ) {
    }

    function index(Request $request): View
    {
        $zodiacs = $this->zodiacRepository->getAll();
        $zodiacId = $request->input('zodiac_id');
        $sabianDegrees = $request->input('sabian_degrees');
        $keyword = $request->input('keyword');

        $selectedValues = [
            'zodiac_id' => $zodiacId,
            'sabian_degrees' => $sabianDegrees,
            'keyword' => $keyword,
        ];
        if (!empty($zodiacId) || !empty($sabianDegrees) || !empty($keyword) ) {
            $sabianPatterns = $this->sabianPatternRepository->searchSabianPattern($selectedValues);
        } else {
            $sabianPatterns = $this->sabianPatternRepository->getAllPaginate();
        }

        return view(
            'admin.pattern.sabian.index',
            compact(['zodiacs', 'selectedValues', 'sabianPatterns'])
        );
    }

    function view(?int $id = null): View
    {
        session(['url' => url()->previous()]);
        $zodiacs = $this->zodiacRepository->getAll();
        $sabianPattern = [];
        if (!empty($id)) {
            $sabianPattern = $this->sabianPatternRepository->find($id);
        }
        return view('admin.pattern.sabian.view', compact(['zodiacs', 'sabianPattern']));
    }

    function create(SabianPatternRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $sabian = $this->sabianPatternRepository->create($data);
        $status = !empty($sabian);
        $message = $status
            ? __('toast.create_success', ['model' => __('sidebar.sabian_pattern')])
            : __('toast.create_failed', ['model' => __('sidebar.sabian_pattern')]);
        return redirect()->route('admin.pattern.sabian-list')
            ->with('status', '作成しました');
        // return redirect()->route('admin.pattern.sabian-list')
        //     ->with('message', $message)->with('status', $status);
    }

    function createBulk(SabianPatternRequest $request): RedirectResponse
    {
        // $data = $request->validated();
        // $sabian = $this->sabianPatternRepository->create($data);
        // $status = !empty($sabian);
        // $message = $status ? __('message.message_toast', ['model' => __('sidebar.sabian_pattern'), 'action' => __('message.create'), 'status' => __('message.success')]) : __('message.message_toast', ['model' => __('sidebar.sabian_pattern'), 'action' => __('message.create'), 'status' => __('message.failed')]);
        return redirect()->route('admin.pattern.sabian-list');
        // ->with('message', $message)->with('status', $status);
    }

    function update(int $id, SabianPatternRequest $request): RedirectResponse
    {
        $dataUpdate = $request->validated();
        if (!isset($dataUpdate['title_en'])) {
            $dataUpdate['title_en'] = null;
        }
        if (!isset($dataUpdate['content_en'])) {
            $dataUpdate['content_en'] = null;
        }
        if (!isset($dataUpdate['content_solar_en'])) {
            $dataUpdate['content_solar_en'] = null;
        }
        if (!isset($dataUpdate['title_solar_en'])) {
            $dataUpdate['title_solar_en'] = null;
        }
        $updateStatus = $this->sabianPatternRepository->update($id, $dataUpdate);
        $message = $updateStatus
            ? __('toast.update_success', ['model' => __('sidebar.sabian_pattern')])
            : __('toast.update_failed', ['model' => __('sidebar.sabian_pattern')]);
            $previousUrl = session('url');
            return redirect($previousUrl)
                ->with('status', '更新しました');
            // return redirect($previousUrl)
            //     ->with('message', $message)->with('status', $updateStatus);
    }

    function delete(int $id): RedirectResponse
    {
        $deleteStatus = $this->sabianPatternRepository->delete($id);
        $message = $deleteStatus
            ? __('toast.delete_success', ['model' => __('sidebar.sabian_pattern')])
            : __('toast.delete_failed', ['model' => __('sidebar.sabian_pattern')]);
        return redirect()->route('admin.pattern.sabian-list')
            ->with('status', '削除しました');
        // return redirect()->route('admin.pattern.sabian-list')
        //     ->with('message', $message)->with('status', $deleteStatus);
    }
}
