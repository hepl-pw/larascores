<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Schedule extends Component
{

    public $matches;
    public $sortStatsKey;
    public $sortMatchesKey;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($matches, $sortStatsKey, $sortMatchesKey)
    {
        $this->matches = $matches;
        $this->sortStatsKey = $sortStatsKey;
        $this->sortMatchesKey = $sortMatchesKey;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.schedule');
    }
}
