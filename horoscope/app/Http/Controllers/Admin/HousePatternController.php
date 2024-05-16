<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use App\Models\HousePattern;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\HouseRepository;
use Illuminate\Http\RedirectResponse;
use App\Repositories\PlanetRepository;
use App\Repositories\HousePatternRepository;
use App\Http\Requests\Admin\HousePatternController\HousePatternRequest;

class HousePatternController extends Controller
{
    public function __construct(
        protected HousePatternRepository $housePatternRepository,
        protected PlanetRepository $PlanetRepository,
        protected HouseRepository $houseRepository
    ) {
    }

    public function index(Request $request): View
    {
        $planets = $this->PlanetRepository->getAll();
        $houses = $this->houseRepository->getAll();

        $houseId = $request->input('house_id');
        $planetId = $request->input('planet_id');
        $keyword = $request->input('keyword');

        $selectedValues = [
            'house_id' => $houseId,
            'planet_id' => $planetId,
            'keyword' => $keyword,
        ];
        if (!empty($houseId) || !empty($planetId) || !empty($keyword) ) {
            $housePatterns = $this->housePatternRepository->searchHouses($selectedValues);
        } else {
            $housePatterns = $this->housePatternRepository->getAllPaginate();
        }

        return view(
            'admin.pattern.house.index',
            compact(['planets', 'houses', 'selectedValues', 'housePatterns'])
        );
    }

    function view(?int $id = null): View
    {
        $houses = $this->houseRepository->getAll();
        $planets = $this->PlanetRepository->getAll();
        $housePattern = [];
        if (!empty($id)) {
            $housePattern = $this->housePatternRepository->find($id);
        }
        session(['url' => url()->previous()]);
        return view(
            'admin.pattern.house.view',
            compact(['houses', 'planets', 'housePattern'])
        );
    }

    function create(HousePatternRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $pattern = $this->housePatternRepository->create($data);
        $status = !empty($pattern);
        $message = $status
            ? __('toast.create_success', ['model' => __('sidebar.house_pattern')])
            : __('toast.create_failed', ['model' => __('sidebar.house_pattern')]);
        return redirect()->route('admin.pattern.house-list')
            ->with('status', '作成しました');
        // return redirect()->route('admin.pattern.house-list')
        //     ->with('message', $message)->with('status', $status);
    }

    function createBulk(HousePatternRequest $request): RedirectResponse
    {
        $requestData = $request->validated();
        foreach ($requestData['patterns'] as $i => $item) {

            if ($item['content']) {
                HousePattern::create([
                    'house_id' => $requestData['house_id'],
                    'zodiac_id' => $requestData['zodiac_id'],
                    'sabian_degrees' => $item['sabian_degrees'],
                    'content' => $item['content'],
                    'content_en' => $item['content_en'],
                ]);
            } else {
                continue;
            }
        }
        return redirect()->route('admin.pattern-house-list')->with('status', '作成しました');
        // return redirect()->route('admin.pattern-house-list')->with('status', 'insert successfull');
    }

    function update(int $id, HousePatternRequest $request): RedirectResponse
    {
        $dataUpdate = $request->validated();
        if (!isset($dataUpdate['content_en'])) {
            $dataUpdate['content_en'] = null;
        }
        $dataUpdate = $request->validated();
        if (!isset($dataUpdate['content_solar_en'])) {
            $dataUpdate['content_solar_en'] = null;
        }
        $updateStatus = $this->housePatternRepository->update($id, $dataUpdate);
        $message = $updateStatus
            ? __('toast.update_success', ['model' => __('sidebar.house_pattern')])
            : __('toast.update_failed', ['model' => __('sidebar.house_pattern')]);
            $previousUrl = session('url');
            return redirect($previousUrl)
                ->with('status', '更新しました');
            // return redirect($previousUrl)
            //     ->with('message', $message)->with('status', $updateStatus);
    }

    function delete(int $id): RedirectResponse
    {
        $deleteStatus = $this->housePatternRepository->delete($id);
        $message = $deleteStatus
            ? __('toast.delete_success', ['model' => __('sidebar.house_pattern')])
            : __('toast.delete_failed', ['model' => __('sidebar.house_pattern')]);
        return redirect()->route('admin.pattern.house-list')
            ->with('status', '削除しました');
        // return redirect()->route('admin.pattern.house-list')
        //     ->with('message', $message)->with('status', $deleteStatus);
    }
}
