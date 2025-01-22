<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PasswordInput extends Component
{

    public $name;
    public $label;
    public $wireModel;
    public $required;

    /**
     * Create a new component instance.
     */
    public function __construct(
        $name = 'password', 
        $label = 'Password',
        $required = false,
        $wireModel
    )
    {
        $this->name = $name;
        $this->label = $label;
        $this->wireModel = $wireModel;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.password-input');
    }
}
