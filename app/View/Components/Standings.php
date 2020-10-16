<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Standings extends Component
{
    public $teamsStats;
    public $sortStatsKey;
    public $sortMatchesKey;
    public $span_years;
    public $competitions;
    public $tournament_id;
    public $competition_id;
    public $season;

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
        $competitionId,
        $season
    ) {
        $this->teamsStats = $teamsStats;
        $this->sortStatsKey = $sortStatsKey;
        $this->sortMatchesKey = $sortMatchesKey;
        $this->span_years = $spanYears;
        $this->competitions = $competitions;
        $this->competition_id = $competitionId;
        $this->season = $season;
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
