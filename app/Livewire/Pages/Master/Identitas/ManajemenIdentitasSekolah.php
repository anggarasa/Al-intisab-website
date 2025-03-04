<?php

namespace App\Livewire\Pages\Master\Identitas;

use App\Models\IdentitasSekolah;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('layouts.master-layout', ['title' => 'Manajemen Identitas Sekolah'])]
#[On('manajemen-identitas-sekolah')]
class ManajemenIdentitasSekolah extends Component
{
    public function editIdentitas($id)
    {
        $this->dispatch('editIdentitas', $id)->to(ModalManajemenIdentitasSekolah::class);
    }

    public function hapusIdentitas($id)
    {
        $this->dispatch('hapusIdentitas', $id)->to(ModalManajemenIdentitasSekolah::class);
    }
    
    public function render()
    {
        $identitasSekolahs = IdentitasSekolah::latest()->get();
        
        return view('livewire.pages.master.identitas.manajemen-identitas-sekolah', compact('identitasSekolahs'));
    }
}
