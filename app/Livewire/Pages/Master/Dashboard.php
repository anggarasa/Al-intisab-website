<?php

namespace App\Livewire\Pages\Master;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.master-layout', ['title' => 'Master'])]
class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.pages.master.dashboard');
    }
}
