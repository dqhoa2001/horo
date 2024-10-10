<?php

namespace Modules\Horoscope\View\Components;

use Illuminate\View\Component;

class PlanetCard extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public $planetExplain,
    ) {

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('horoscope::components.Planetcard');
    }
}