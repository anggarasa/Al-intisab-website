<?php

namespace App\Livewire\Pages\TataUsaha;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.tatausaha-layout', ['title' => 'Tata Usaha'])]
class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.pages.tata-usaha.dashboard');
    }
}
