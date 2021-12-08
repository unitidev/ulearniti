<?php

namespace App\View\Components\input;

use Illuminate\View\Component;

class LabelIcon extends Component
{
    public $type;
    public $label;
    public $icon;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type, $label, $icon)
    {
        $this->type = $type;
        $this->label = $label;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input.label-icon');
    }
}
