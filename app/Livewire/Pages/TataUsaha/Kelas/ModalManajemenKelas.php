<?php

namespace App\Livewire\Pages\TataUsaha\Kelas;

use App\Models\Kelas;
use Livewire\Component;
use App\Livewire\Pages\TataUsaha\Kelas\ManajemenKelas;
use App\Models\Jurusan;

class ModalManajemenKelas extends Component
{
    public $nama_kelas, $jurusan;

    // Create kelas
    public function createKelas()
    {
        try {
            $this->validate([
                'nama_kelas' => 'required|string|max:255',
                'jurusan' => 'required|integer',
            ]);

            // simpan kelas
            Kelas::create([
                'jurusan_id' => $this->jurusan,
                'nama_kelas' => $this->nama_kelas,
            ]);

            // kirim data untuk di tampilkan secara realtime
            $this->dispatch('management-kelas')->to(ManajemenKelas::class);

            // Reset input forom
            $this->resetInput();

            // Notification success
            $this->dispatch('notificationTataUsaha', [
                'type' => 'success',
                'message' => 'Berhasil menambahkan kelas baru',
                'title' => 'Sukses',
            ]);
        } catch (\Exception $e) {
            // Notification error
            $this->dispatch('notificationTataUsaha', [
                'type' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Gagal'
            ]);
        }
    }
    // End Create kelas 
    
    public function render()
    {
        return view('livewire.pages.tata-usaha.kelas.modal-manajemen-kelas', [
            'jurusans' => Jurusan::all()
        ]);
    }

    // REset input setelah poses penyimpanan & update
    public function resetInput()
    {
        $this->reset(['nama_kelas', 'jurusan']);

        $this->dispatch('close-modal-kelas');
    }

    protected $messages = [
        'nama_kelas.required' => 'Nama kelas harus diisi',
        'nama_kelas.string' => 'Nama kelas harus berupa teks',
        'nama_kelas.max' => 'Nama kelas tidak boleh lebih dari 255 karakter',
        'jurusan.required' => 'Jurusan harus diisi',
        'jurusan.integer' => 'Jurusan harus berupa angka',
    ];
}