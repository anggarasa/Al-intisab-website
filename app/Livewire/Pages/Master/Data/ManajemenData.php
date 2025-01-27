<?php

namespace App\Livewire\Pages\Master\Data;

use App\Models\Agama;
use App\Models\Guru\JenisPtk;
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

    // Edit Agama
    public function editAgama($id)
    {
        $this->dispatch('editAgama', $id)->to(ModalManajemenData::class);
    }
    // End Edit Agama

    // Edit Ptk
    public function editPtk($id)
    {
        $this->dispatch('editPtk', $id)->to(ModalManajemenData::class);
    }
    // End Edit Ptk

    // hapus gender
    public function hapusData($id, $deleteType)
    {
        $this->dispatch('hapusData', $id, $deleteType)->to(ModalManajemenData::class);
    }
    // End hapus gender
    
    public function render()
    {
        $genderes = JenisKelamin::latest()->paginate(5);
        $agamas = Agama::latest()->paginate(5);
        $ptks = JenisPtk::latest()->paginate(5);
        return view('livewire.pages.master.data.manajemen-data', compact(['genderes', 'agamas', 'ptks']));
    }
}
