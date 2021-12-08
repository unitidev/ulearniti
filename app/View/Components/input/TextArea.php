<?php

namespace App\View\Components\input;

use Illuminate\View\Component;

class TextArea extends Component
{
    public $placeholder;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($placeholder)
    {
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input.text-area');
    }
}
