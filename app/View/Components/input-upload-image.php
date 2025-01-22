<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputUploadImage extends Component
{
    public $name;
    public $id;
    public $label;

    /**
     * Create a new component instance.
     *
     * @param string $name
     * @param string|null $id
     * @param string|null $label
     */
    public function __construct($name, $id = null, $label = null)
    {
        $this->name = $name;
        $this->id = $id;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-upload-image');
    }
}
