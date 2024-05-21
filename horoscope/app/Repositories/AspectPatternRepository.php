<?php

namespace App\Repositories;

use App\Enums\PaginateEnum;
use App\Repositories\EloquentRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class AspectPatternRepository extends EloquentRepository
{
    /**
     * get model
     *
     * @return string
     */
    public function getModel()
    {
        return \App\Models\AspectPattern::class;
    }

    public function searchAspectPatterns(array $selectedValues): LengthAwarePaginator
    {
        return $this->_model
            ->where(static function (Builder $query) use ($selectedValues) {
                if (!empty($selectedValues['aspect_id'])) {
                    $query->where('aspect_id', '=', $selectedValues['aspect_id']);
                }
                if (!empty($selectedValues['from_planet_id'])) {
                    $query->where('from_planet_id', '=', $selectedValues['from_planet_id']);
                }
                if (!empty($selectedValues['to_planet_id'])) {
                    $query->where('to_planet_id', '=', $selectedValues['to_planet_id']);
                }
                if (!empty($selectedValues['keyword'])) {
                    $query->where(static function ($subQuery) use ($selectedValues) {
                        $subQuery->where('content', 'LIKE', '%' . $selectedValues['keyword'] . '%')
                            ->orWhere('content_en', 'LIKE', '%' . $selectedValues['keyword'] . '%')
                            ->orWhere('content_solar', 'LIKE', '%' . $selectedValues['keyword'] . '%')
                            ->orWhere('content_solar_en', 'LIKE', '%' . $selectedValues['keyword'] . '%');
                    });
                }
            })
            ->paginate(PaginateEnum::Limit);
    }
}
