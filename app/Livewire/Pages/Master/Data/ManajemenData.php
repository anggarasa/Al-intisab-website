<?php

namespace App\Livewire\Pages\Master\Data;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\JenisKelamin;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.master-layout', ['title' => 'Manajemen Data'])]
#[On('manajemen-data')]
class ManajemenData extends Component
{
    use WithPagination;

    // Edit Gender
    public function editGender($id)
    {
        $this->dispatch('editGender', $id)->to(ModalManajemenData::class);
    }
    // End Edit Gender

    // hapus gender
    public function hapusGender($id)
    {
        $this->dispatch('hapusGender', $id)->to(ModalManajemenData::class);
    }
    // End hapus gender
    
    public function render()
    {
        $genderes = JenisKelamin::latest()->paginate(5);
        return view('livewire.pages.master.data.manajemen-data', compact(['genderes']));
    }
}
