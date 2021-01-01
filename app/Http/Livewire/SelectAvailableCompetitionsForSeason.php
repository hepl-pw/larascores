<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SelectAvailableCompetitionsForSeason extends Component
{
    public $competitions;
    public $competition;
    public $competitionId;

    protected $rules = [
        'competition' => 'required',
    ];

    public function updatedCompetitionId()
    {
        //dd($this->competition);
        $this->emit('competitionsSelectChanged', $this->competition);
    }

    public function render()
    {
        return view('livewire.select-available-competitions-for-season');
    }
}
