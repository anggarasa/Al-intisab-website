<?php

namespace App\Livewire\Pages\Master\Data\JenisPtk;

use App\Models\Guru\JenisPtk as GuruJenisPtk;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.master-layout', ['title' => 'Jenis PTK'])]
#[On('jenis-ptk')]
class JenisPtk extends Component
{
    use WithPagination;
    
    public function editPtk($id)
    {
        $this->dispatch('editPtk', $id)->to(ModalJenisPtk::class);
    }

    public function hapusPtk($id)
    {
        $this->dispatch('hapusPtk', $id)->to(ModalJenisPtk::class);
    }
    
    public function render()
    {
        $jenisPtks = GuruJenisPtk::latest()->paginate(5);
        
        return view('livewire.pages.master.data.jenis-ptk.jenis-ptk', compact('jenisPtks'));
    }
}
