<?php

namespace App\View\Components\_lvz\layouts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Main extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $showAuth = 'show',
        public $showStatus = 'show',
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('_lvz.layouts.main');
    }
}
