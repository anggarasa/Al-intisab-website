<?php

namespace App\Livewire\Pages\Master\Pembayaran\JenisPembayaran;

use App\Models\TataUsaha\Pembayaran\JenisPembayaran;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.master-layout', ['title' => 'Manajemen Jenis Pembayaran'])]
#[On('manajemen-jenis-pembayaran')]
class ManajemenJenisPembayaran extends Component
{
    use WithPagination;

    // edit jenis pembayaran
    public function editJenisPembayaran($id)
    {
        $this->dispatch('editJenisPembayaran', $id)->to(ModalManajemenJenisPembayaran::class);
    }
    // End edit jenis pembayaran

    // hapus jenis pembayaran
    public function hapusJenisPembayaran($id)
    {
        $this->dispatch('hapusJenisPembayaran', $id)->to(ModalManajemenJenisPembayaran::class);
    }
    // End hapus jenis pembayaran
    
    public function render()
    {
        $jenisPembayarans = JenisPembayaran::latest()->paginate(5);
        
        return view('livewire.pages.master.pembayaran.jenis-pembayaran.manajemen-jenis-pembayaran', compact('jenisPembayarans'));
    }
}
