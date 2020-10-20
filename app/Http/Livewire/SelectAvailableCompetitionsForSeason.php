<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SelectAvailableCompetitionsForSeason extends Component
{
    public $competitions;
    public $competition_id;

    public function updateSeasonsSelect()
    {
        $this->emit('competitionsSelectChanged', $this->competition_id);
    }

    public function render()
    {
        return view('livewire.select-available-competitions-for-season');
    }
}
