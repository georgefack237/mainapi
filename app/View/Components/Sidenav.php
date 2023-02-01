<?php

namespace App\View\Components;

use App\Models\alert;
use Illuminate\View\Component;

class Sidenav extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $alertsCount = alert::where('checked', false)->count();
        return view('components.sidenav', compact('alertsCount'));
    }
}
