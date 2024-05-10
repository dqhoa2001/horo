<?php

namespace App\Repositories;

use App\Enums\PaginateEnum;
use App\Repositories\EloquentRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class SabianPatternRepository extends EloquentRepository
{
    /**
     * get model
     *
     * @return string
     */
    public function getModel()
    {
        return \App\Models\SabianPattern::class;
    }

    public function searchSabianPattern(array $selectedValues): LengthAwarePaginator
    {
        return $this->_model
            ->when(!empty($selectedValues['zodiac_id']), static function ($query) use ($selectedValues) {
                $query->where('zodiac_id', '=', $selectedValues['zodiac_id']);
            })
            ->when(!empty($selectedValues['sabian_degrees']), static function ($query) use ($selectedValues) {
                $query->where('sabian_degrees', '=', $selectedValues['sabian_degrees']);
            })
            ->when(!empty($selectedValues['keyword']), static function ($query) use ($selectedValues) {
                $query->where(static function ($subQuery) use ($selectedValues) {
                    $subQuery->where('content', 'LIKE', '%' . $selectedValues['keyword'] . '%')
                        ->orWhere('content_en', 'LIKE', '%' . $selectedValues['keyword'] . '%')
                        ->orWhere('title', 'LIKE', '%' . $selectedValues['keyword'] . '%')
                        ->orWhere('title_en', 'LIKE', '%' . $selectedValues['keyword'] . '%');
                });
            })
            ->paginate(PaginateEnum::Limit);
    }
}
