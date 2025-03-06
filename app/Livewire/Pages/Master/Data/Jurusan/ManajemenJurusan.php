<?php

namespace App\Livewire\Pages\Master\Data\Jurusan;

use App\Models\Jurusan;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.master-layout', ['title' => 'Manajemen Jurusan'])]
#[On('manajemen-jurusan')]
class ManajemenJurusan extends Component
{
    use WithPagination;

    public function editJurusan($id)
    {
        $this->dispatch('editJurusan', $id)->to(ModalManajemenJurusan::class);
    }

    public function hapusJurusan($id)
    {
        $this->dispatch('hapusJurusan',  $id)->to(ModalManajemenJurusan::class);
    }
    
    public function render()
    {
        $jurusans = Jurusan::latest()->paginate(5);
        
        return view('livewire.pages.master.data.jurusan.manajemen-jurusan', compact(['jurusans']));
    }
}
