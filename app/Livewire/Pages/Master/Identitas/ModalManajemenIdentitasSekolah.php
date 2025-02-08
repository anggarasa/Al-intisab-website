<?php

namespace App\Livewire\Pages\Master\Identitas;

use Livewire\Component;

class ModalManajemenIdentitasSekolah extends Component
{
    public $name, $kepala_sekolah, $email, $noHp, $npsn, $kelurahan, $kecamatan, $kota, $provinsi, $pos, $akreditasi, $alamat;
    
    public $isEdit = false, $identitasId;
    
    public function render()
    {
        return view('livewire.pages.master.identitas.modal-manajemen-identitas-sekolah');
    }

    // reset input
    public function resetInput()
    {
        $this->reset(['name', 'kepala_sekolah', 'email', 'noHp', 'npsn', 'kelurahan', 'kecamatan', 'kota', 'provinsi', 'pos', 'akreditasi', 'alamat', 'identitasId']);

        $this->isEdit = false;

        $this->dispatch('close-modal-crud-identitas');
    }
}
