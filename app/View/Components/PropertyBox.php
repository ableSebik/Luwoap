<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PropertyBox extends Component
{
    public $prop;

    /**
     * Create a new component instance.
     *
     * @param  mixed  $prop
     * @return void
     */
    public function __construct($prop)
    {
        $this->prop = $prop;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.property-box');
    }
}
