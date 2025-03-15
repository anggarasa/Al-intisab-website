<?php

namespace App\Livewire\Layout\Master;

use App\Models\IdentitasSekolah;
use Livewire\Attributes\On;
use Livewire\Component;

#[On('update-logo')]
class Sidebar extends Component
{
    public function render()
    {
        $logos = IdentitasSekolah::all();
        return view('livewire.layout.master.sidebar', compact('logos'));
    }
}
