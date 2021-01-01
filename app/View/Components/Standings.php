<?php

namespace App\View\Components;

use App\Models\Tournament;
use Illuminate\View\Component;

class Standings extends Component
{
    public $teamsStats;
    public $sortStatsKey;
    public $sortMatchesKey;
    public $span_years;
    public $competitions;
    public $competition;
    public $season;
    public $tournament;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $teamsStats,
        $sortStatsKey,
        $sortMatchesKey,
        $spanYears,
        $competitions,
        $competition,
        $season
    ) {
        $this->teamsStats = $teamsStats;
        $this->sortStatsKey = $sortStatsKey;
        $this->sortMatchesKey = $sortMatchesKey;
        $this->span_years = $spanYears;
        $this->competitions = $competitions;
        $this->competition = $competition;
        $this->season = $season;
        $this->tournament = Tournament::where('competition_id', $competition->id)
            ->where('span_years', $season)
            ->first();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.standings');
    }
}
