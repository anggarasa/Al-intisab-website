<?php

namespace App\Livewire\Pages\Master\Pembayaran\JenisPembayaran;

use App\Models\TataUsaha\Pembayaran\JenisPembayaran;
use Livewire\Attributes\On;
use Livewire\Component;

use function Pest\Laravel\call;

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
            $this->dispatch('notificationMaster', [
                'type' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Gagal!',
            ]);
        }
    }
    // End tambah jenis pembayaran

    // Update jenis pembayaran
    #[On('editJenisPembayaran')]
    public function editJenisPembayara($id)
    {
        $this->isEdit = true;
        $jenisPembayaran = JenisPembayaran::find($id);
        $this->jenisPembayaranId = $jenisPembayaran->id;
        $this->jenisPembayaran = $jenisPembayaran->nama_pembayaran;
        $this->total = $jenisPembayaran->total;

        // open modal
        $this->dispatch('modal-crud-jenis-pembayaran');
    }

    public function updateJenisPembayaran()
    {
        try {
            $this->validate([
                'jenisPembayaran' => ['required', 'string', 'max:255'],
                'total' => ['required', 'numeric'],
            ]);

            // simpan update jenis pembayaran
            $jenisPembayaran = JenisPembayaran::find($this->jenisPembayaranId);
            $jenisPembayaran->update([
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
                'message' => 'Berhasil mengubah jenis pembayaran!',
                'title' => 'Berhsil!',
            ]);
        } catch (\Exception $e) {
            // kirim notifikasi error
            $this->dispatch('notificationMaster', [
                'type' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Gagal!',
            ]);
        }
    }
    // End Update jenis pembayaran
    
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
