<?php

namespace App\Livewire\Pages\Master\Data\JenisPtk;

use App\Livewire\Pages\Master\Data\JenisPtk\JenisPtk as JenisPtkJenisPtk;
use App\Models\Guru\JenisPtk;
use Livewire\Attributes\On;
use Livewire\Component;

class ModalJenisPtk extends Component
{
    public $ptk, $ptkKet;
    public $ptkId, $isEdit = false;

    public function tambahPtk()
    {
        try {
            $this->validate([
                'ptk' => ['required', 'string', 'max:255'],
                'ptkKet' => ['nullable', 'max:100'],
            ]);

            JenisPtk::create([
                'jenis_ptk' => $this->ptk,
                'keterangan' => $this->ptkKet,
            ]);

            // menampilkan data real-time
            $this->dispatch('jenis-ptk')->to(JenisPtkJenisPtk::class);

            // kirim notification success
            $this->dispatch('notificationMaster', [
                'type' => 'success',
                'message' => 'Berhasil menambahkan jenis PTK '. $this->ptk,
                'title' => 'Berhasil'
            ]);
            
            // reset
            $this->resetInput();
        } catch (\Exception $e) {
            // kirim notification error
            $this->dispatch('notificationMaster', [
                'type' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Gagal',
            ]);
        }
    }

    // update ptk
    #[On('editPtk')]
    public function editPtk($id)
    {
        $this->isEdit = true;
        $ptk = JenisPtk::find($id);
        $this->ptkId = $ptk->id;
        $this->ptk = $ptk->jenis_ptk;
        $this->ptkKet = $ptk->keterangan;

        $this->dispatch('modal-crud-ptk');
    }

    public function updatePtk()
    {
        try {
            $this->validate([
                'ptk' => ['required', 'string', 'max:255'],
                'ptkKet' => ['nullable', 'string', 'max:100']
            ]);

            $ptk = JenisPtk::find($this->ptkId);
            $ptk->update([
                'jenis_ptk' => $this->ptk,
                'keterangan' => $this->ptkKet
            ]);

            // menampilkan data real-time
            $this->dispatch('jenis-ptk')->to(JenisPtkJenisPtk::class);

            $this->dispatch('notificationMaster', [
                'type' => 'success',
                'message' => 'Berhasil mengubah jenis ptk '. $this->ptk,
                'title' => 'Berhasil'
            ]);

            // reset
            $this->resetInput();
        } catch (\Exception $e) {
            $this->dispatch('notificationMaster', [
                'type' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Gagal'
            ]);
        }
    }
    // end update ptk

    // delete ptk
    #[On('hapusPtk')]
    public function hapusPtk($id)
    {
        $ptk = JenisPtk::find($id);
        $this->ptkId = $ptk->id;
        $this->ptk = $ptk->jenis_ptk;

        $this->dispatch('modal-delete-ptk');
    }

    public function deletePtk()
    {
        $ptk = JenisPtk::find($this->ptkId);

        $ptk->delete();

        // menampilkan data real-time
        $this->dispatch('jenis-ptk')->to(JenisPtkJenisPtk::class);

        $this->dispatch('notificationMaster', [
            'type' => 'success',
            'message' => 'Berhasil menghapus jenis ptk '. $this->ptk,
            'title' => 'Berhasil'
        ]);
        
        $this->resetInput();
    }
    // End delete ptk
    
    public function render()
    {
        return view('livewire.pages.master.data.jenis-ptk.modal-jenis-ptk');
    }

    // Reset input
    public function resetInput()
    {
        $this->reset(['ptk', 'ptkKet', 'ptkId']);
        $this->isEdit = false;

        $this->dispatch('close-modal-crud-ptk');
        $this->dispatch('close-modal-delete-ptk');
    }

    // custom message
    protected $messages = [
        'ptk.required' => 'Jenis PTK harus diisi.',
        'ptk.string' => 'Jenis PTK harus berupa teks.',
        'ptk.max' => 'Jenis PTK tidak boleh lebih dari 255 karakter.',
        'ptkKet.string' => 'Keterangan harus berupa teks.',
        'ptkKet.max' => 'Keterangan tidak boleh lebih dari 100 karakter.',
    ];
}
