<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MatchForm extends Component
{
    public $teams;
    public $tournaments;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($teams, $tournaments)
    {
        $this->teams = $teams;
        $this->tournaments = $tournaments;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.match-form');
    }
}
