<?php

namespace Modules\Horoscope\Http\Actions\CalculateDegree\Aspect;

use Illuminate\Support\Collection;
use Modules\Horoscope\Enums\AngleEnum;
use Modules\Horoscope\Enums\WheelColorEnum;

class FindAspecLine
{
    /**
     *
     *  find and add aspect line degree by angle by planets, return list aspect line
     *
     * @param float $ascendant
     * @param Collection $planets
     * @param Collection
     */
    function execute(float $ascendant, Collection $planets,bool $solar): Collection
    {
        $aspectLine = new Collection();
        $asp = [];
        for ($i = 0; $i <= 10; $i++) {
            $aspects = new Collection();
            $aspectTo = new Collection();

            if ($solar && $i == 10) {
                continue;
            }
            $aspects->put('from', collect([
                $planets[$i]->get('name') => collect([
                    'degrees' => $planets[$i]->get('degrees') - $ascendant,
                    'planet_num' => $planets[$i]->get('planet_num'),
                    'name' => $planets[$i]->get('name'),
                ])
            ]));

            $aspects->put('to', new Collection());
            $aspectTo = new Collection();
            for ($j = 0; $j <= 11; $j++) {

                // @MOD 2023/12/13 by kaibetty.
                //  ドラゴンヘッド(idx==10)は0度, 180度の時だけ採用するよう変更
                if ($solar && $j == 10) {
                    continue;
                }

                $q = -1; // @MOD 2023/12/13  デフォルト値:-1 コンジャンクションで"0"を使うため
                $fromDegrees = $planets[$i]->get('degrees');
                $toDegrees = $planets[$j]->get('degrees');

                $da = Abs($fromDegrees - $toDegrees);

                if ($da > AngleEnum::HalfRound) {
                    $da = AngleEnum::Round - $da;
                }

                // set orb - 8 if Sun or Moon, 6 if not Sun or Moon
                if ($i == 0 or $i == 1 or $j == 0 or $j == 1) {
                    $orb = 8;
                } else {
                    $orb = 6;
                }

                // is there an aspect within orb ?
                if (($da <= (0 + $orb)) and ($da >= (0 - $orb))) { // @MOD 2023/12/13 by kaibetty.
                    // @MOD 2023/12/13 by kaibetty.
                    // no Conjunction(aspect1) for the planet itself
                    if ($i != $j) {
                        $q = 0;
                    }
                } elseif (($da <= (30 + $orb)) and ($da >= (30 - $orb))) {
                    $q = 30;
                } elseif (($da <= (45 + $orb)) and ($da >= (45 - $orb))) {
                    $q = 45;
                } elseif (($da <= (60 + $orb)) and ($da >= (60 - $orb))) {
                    $q = 60;
                } elseif (($da <= (90 + $orb)) and ($da >= (90 - $orb))) {
                    $q = 90;
                } elseif (($da <= (120 + $orb)) and ($da >= (120 - $orb))) {
                    $q = 120;
                } elseif (($da <= (150 + $orb)) and ($da >= (150 - $orb))) {
                    $q = 150;
                } elseif ($da >= (180 - $orb)) {
                    $q = 180;
                }

                // @ADD 2023/12/13 by kaibetty.
                //  ドラゴンヘッド(idx==10)の処理条件を追加
                //  条件：は0度, 180度の時だけ採用、それ以外は処理をスキップする
                if ($i == 10 || $j == 10) {
                    if ($q != 0 && $q != 180) {
                        continue;
                    }
                }

                // @MOD 2023/12/13 by kaibetty.
                //  "$q==0" (conjunction) added
                if ($q == 0 || $q == 60 || $q == 90 || $q == 120 || $q == 180) {
                    $asp[$i][$j] = $q;
                    $aspectTo->put($planets[$j]->get('name'), collect([
                        'degrees' => $planets[$j]->get('degrees') - $ascendant,
                        'name' => $planets[$j]->get('name'),
                        'planet_num' => $planets[$j]->get('planet_num'),
                        'case' => $q,
                        'color' => ($q == 60 || $q == 120)
                            ? WheelColorEnum::Blue
                            : WheelColorEnum::Red
                    ]));
                }
            }
            $aspects->put('to', $aspectTo);
            $aspectLine->push($aspects);
            $planets[$i]->put('aspects', $aspects->get('to'));
        }
        # add aspects to planets list
        return $aspectLine;
    }
}
