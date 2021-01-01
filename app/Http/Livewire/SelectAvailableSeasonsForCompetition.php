<?php

namespace App\Http\Livewire;

use App\Models\Competition;
use Livewire\Component;

class SelectAvailableSeasonsForCompetition extends Component
{
    public $span_years;
    public $season;

    protected $listeners = [
        'competitionsSelectChanged' => 'updateSeasons'
    ];

    public function updateSeasons(Competition $competition)
    {
        $this->span_years = $competition->span_years;
        $this->emit('seasonsChanged', $this->season);
    }

    public function updatedSeason()
    {
        $this->emit('seasonsChanged', $this->season);
    }

    public function render()
    {
        return view('livewire.select-available-seasons-for-competition');
    }
}
