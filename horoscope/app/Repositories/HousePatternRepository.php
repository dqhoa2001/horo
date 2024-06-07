<?php

namespace App\Repositories;

use App\Enums\PaginateEnum;
use App\Repositories\EloquentRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class HousePatternRepository extends EloquentRepository
{
    /**
     * get model
     *
     * @return string
     */
    public function getModel()
    {
        return \App\Models\HousePattern::class;
    }

    public function searchHouses(array $selectedValues): LengthAwarePaginator
    {
        return $this->_model
            ->where(static function (Builder $query) use ($selectedValues) {
                if (!empty($selectedValues['house_id'])) {
                    $query->where('house_id', '=', $selectedValues['house_id']);
                }
                if (!empty($selectedValues['planet_id'])) {
                    $query->where('planet_id', '=', $selectedValues['planet_id']);
                }
                if (!empty($selectedValues['keyword'])) {
                    $keyword = $selectedValues['keyword'];
                    $query->where(static function ($subQuery) use ($keyword) {
                        $subQuery->where('content', 'LIKE', '%' . $keyword . '%')
                            ->orWhere('content_en', 'LIKE', '%' . $keyword . '%');
                    });
                }
            })
            ->paginate(PaginateEnum::Limit);
    }
}
