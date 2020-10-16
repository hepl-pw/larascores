<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class TeamForm extends Component
{

    public $teams;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($teams)
    {
        $this->teams = $teams;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.team-form');
    }
}
