<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SidebarDropdown extends Component
{
    public $title;
    public $icon;
    public $links;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $icon = null, $links = [])
    {
        $this->title = $title;
        $this->icon = $icon;
        $this->links = $links;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar-dropdown');
    }
}
