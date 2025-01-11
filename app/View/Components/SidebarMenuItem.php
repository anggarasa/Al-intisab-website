<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SidebarMenuItem extends Component
{
    public $href;
    public $label;
    public $icon;
    public $active;

    public function __construct($href = '#', $label = '', $icon = null, $active = false)
    {
        $this->href = $href;
        $this->label = $label;
        $this->icon = $icon;
        $this->active = $active;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar-menu-item');
    }
}
