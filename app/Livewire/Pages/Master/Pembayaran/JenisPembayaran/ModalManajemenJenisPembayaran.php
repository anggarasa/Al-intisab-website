<?php

namespace App\Livewire\Pages\Master\Pembayaran\JenisPembayaran;

use App\Models\TataUsaha\Pembayaran\JenisPembayaran;
use Livewire\Component;

class ModalManajemenJenisPembayaran extends Component
{
    public $jenisPembayaran, $total;
    public $jenisPembayaranId, $isEdit = false;

    // tambah jenis pembayaran
    public function tambahJenisPembayaran()
    {
        try {
            $this->validate([
                'jenisPembayaran' => ['required', 'string', 'max:255'],
                'total' => ['required', 'numeric'],
            ]);

            // simpan jenis pembayaran
            JenisPembayaran::create([
                'nama_pembayaran' => $this->jenisPembayaran,
                'total' => $this->total,
            ]);

            // menampilkan data real-time
            $this->dispatch('manajemen-jenis-pembayaran')->to(ManajemenJenisPembayaran::class);

            // reset input
            $this->resetInput();

            // kirim notifikasi success
            $this->dispatch('notificationMaster', [
                'type' => 'success',
                'message' => 'Berhasil menambahkan jenis pembayaran.',
                'title' => 'Berhasil!',
            ]);
        } catch (\Exception $e) {
            // kirim notifikasi error
            // $this->dispatch('notificationMaster', [
            //     'type' => 'error',
            //     'message' => $e->getMessage(),
            //     'title' => 'Gagal!',
            // ]);
            dd($e->getMessage());
        }
    }
    // End tambah jenis pembayaran
    
    public function render()
    {
        return view('livewire.pages.master.pembayaran.jenis-pembayaran.modal-manajemen-jenis-pembayaran');
    }

    // reset input
    public function resetInput()
    {
        $this->reset(['jenisPembayaran', 'total', 'jenisPembayaranId']);
        $this->isEdit = false;

        // clos modal
        $this->dispatch('close-modal-crud-jenis-pembayaran');
    }

    // custom message
    protected $messages = [
        'jenisPembayaran.required' => 'Jenis pembayaran harus diisi.',
        'jenisPembayaran.string' => 'Jenis pembayaran harus berupa teks.',
        'jenisPembayaran.max' => 'Jenis pembayaran maksimal 255 karakter.',
        'total.required' => 'Total harus diisi.',
        'total.numeric' => 'Total harus berupa angka.',
    ];
}
