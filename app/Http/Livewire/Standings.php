<?php

namespace App\Http\Livewire;

use App\Models\Competition;
use Livewire\Component;

class Standings extends Component
{
    public $data;
    public $teamsStats;
    public $sortStatsKey;
    public $sortMatchesKey;
    public $span_years;
    public $competitions;
    public $matches;
    public $competition;
    public $competitionId;
    public $season;

    protected $listeners = [
        'competitionsSelectChanged' => 'updateStandings'
    ];

    public function updateStandings(Competition $competition)
    {
        // $this->competitionId = $competition->id;
        $this->competition = $competition;
    }

    public function render()
    {
        return view('livewire.standings');
    }
}
