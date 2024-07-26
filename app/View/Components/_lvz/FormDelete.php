<?php

namespace App\View\Components\_lvz;

use Illuminate\View\Component;

class FormDelete extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public string $action
    )
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
        return view('_lvz.components.form-delete');
    }
}
