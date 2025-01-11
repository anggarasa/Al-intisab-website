<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class input extends Component
{
    public $type;
    public $name;
    public $label;
    public $placeholder;
    public $value;
    public $required;
    public $disabled;
    public $class;
    public $wire;

    public function __construct(
        $type = 'text', 
        $name = '', 
        $label = '', 
        $placeholder = '', 
        $value = null, 
        $required = false,
        $disabled = false,
        $class = null,
        $wire = null
    ) {
        $this->type = $type;
        $this->name = $name;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->required = $required;
        $this->disabled = $disabled;
        $this->class = $class;
        $this->wire = $wire;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input');
    }
}
