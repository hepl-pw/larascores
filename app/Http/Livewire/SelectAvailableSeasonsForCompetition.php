<?php

namespace App\Http\Livewire;

use App\Models\Competition;
use App\Models\Tournament;
use Livewire\Component;

class SelectAvailableSeasonsForCompetition extends Component
{
    public $span_years;
    public $season;

    public $listeners = ['competitionsSelectChanged' => 'updateSeasons'];

    public function updateSeasons(Competition $competition)
    {
        $this->span_years = $competition->span_years;
    }

    public function render()
    {
        return view('livewire.select-available-seasons-for-competition');
    }
}
