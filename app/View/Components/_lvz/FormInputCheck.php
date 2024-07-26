<?php

namespace App\View\Components\_lvz;

use Illuminate\View\Component;

class FormInputCheck extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public bool $checked = FALSE
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
        return view('_lvz.components.form-input-check');
    }
}
