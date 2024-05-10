<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\FamilyHoroscopeController\StoreRequest;
use App\Http\Requests\User\FamilyHoroscopeController\UpdateRequest;
use App\Models\FamilyHoroscope;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FamilyHoroscopeController extends Controller
{
    private FamilyHoroscope $familyHoroscope;

    /**
     * @param FamilyHoroscope $familyHoroscope
     */
    public function __construct(FamilyHoroscope $familyHoroscope)
    {
        $this->familyHoroscope = $familyHoroscope;
    }

    public function index(Request $request): View
    {
        return view('user.family_horoscopes.familyhoroscope-list', [
            'familyHoroscopes' => FamilyHoroscope::latest()->paginate(12),
        ]);
    }

    public function create(): View
    {        
        return view('user.family_horoscopes.familyhoroscope-create');
    }

    /**
     * 詳細表示
     *
     * @return \Illuminate\View\View
     */
    public function show(FamilyHoroscope $familyHoroscope): View
    {        
        return view('user.family_horoscopes.familyhoroscope-detail', [
            'familyHoroscope' => $familyHoroscope,
        ]);
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $this->familyHoroscope->fill($request->substitutable())->save();

        return to_route('user.family_horoscopes.index')->with('status', '作成しました');
    }

    public function edit(FamilyHoroscope $familyHoroscope): View
    {
        return view('user.family_horoscopes.edit', [
            'familyHoroscope' => $familyHoroscope,
        ]);
    }

    public function update(UpdateRequest $request, FamilyHoroscope $familyHoroscope): RedirectResponse
    {
        $familyHoroscope->fill($request->substitutable())->save();

        return back()->with('status', '更新しました');
    }
}