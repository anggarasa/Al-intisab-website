<?php

namespace App\Livewire\Pages\Master\Data\Agama;

use App\Models\Agama;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.master-layout', ['title' => 'Manajemen Agama'])]
#[On('manajemen-agama')]
class ManajemenAgama extends Component
{
    use WithPagination;

    public function editAgama($id)
    {
        $this->dispatch('editAgama', $id)->to(ModalManajemenAgama::class);
    }

    public function hapusAgama($id)
    {
        $this->dispatch('hapusAgama', $id)->to(ModalManajemenAgama::class);
    }
    
    public function render()
    {
        $agamas = Agama::latest()->paginate(5);
        
        return view('livewire.pages.master.data.agama.manajemen-agama', compact('agamas'));
    }
}
