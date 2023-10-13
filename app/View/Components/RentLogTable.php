<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RentLogTable extends Component
{
    public $rentlog;

    public function __construct($rentlog)
    {
        $this->rentlog = $rentlog;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.rent-log-table');
    }
}
