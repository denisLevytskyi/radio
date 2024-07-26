<?php

namespace App\View\Components\_lvz;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatusError extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $messages
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('_lvz.components.status-error');
    }
}
