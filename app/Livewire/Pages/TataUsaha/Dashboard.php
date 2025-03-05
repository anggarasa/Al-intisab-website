<?php

namespace App\Livewire\Pages\TataUsaha;

use App\Models\IdentitasSekolah;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.tatausaha-layout', ['title' => 'Tata Usaha'])]
class Dashboard extends Component
{
    public $identitas;

    public function mount()
    {
        $this->identitas = IdentitasSekolah::first();
    }
    
    public function render()
    {
        return view('livewire.pages.tata-usaha.dashboard');
    }
}
