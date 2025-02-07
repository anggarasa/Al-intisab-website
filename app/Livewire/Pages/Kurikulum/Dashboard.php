<?php

namespace App\Livewire\Pages\Kurikulum;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.kurikulum-layout', ['title' => 'Dashboard Kurikulum'])]
class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.pages.kurikulum.dashboard');
    }
}
