<?php

namespace App\Livewire\Pages\TataUsaha\Pembayaran\RiwayatPembayaran;

use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use App\Models\TataUsaha\Transaksi;
use App\Models\TataUsaha\Pembayaran\JenisPembayaran;

#[Layout('layouts.tatausaha-layout', ['title' => 'Riwayat Pembayaran'])]
class RiwayatPembayaran extends Component
{
    use WithPagination;
    
    public $jenisPembayarans;

    #[Url] public $search = '';
    #[Url] public $searchJenisPembayaran = '';
    #[Url] public $searchTanggalPembayaran = '';

    public function mount()
    {
        $this->jenisPembayarans = JenisPembayaran::all();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSearchJenisPembayaran()
    {
        $this->resetPage();
    }

    public function updatingSearchTanggalPembayaran()
    {
        $this->resetPage();
    }
    
    public function render()
    {
        $transaksis = Transaksi::with(['siswa', 'tagihan', 'tagihan.jenisPembayaran'])
            ->when($this->search, function ($query) {
                $query->whereHas('siswa', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('nisn', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->searchJenisPembayaran, function ($query) {
                $query->whereHas('tagihan.jenisPembayaran', function ($q) {
                    $q->where('id', $this->searchJenisPembayaran);
                });
            })
            ->when($this->searchTanggalPembayaran, function ($query) {
                $query->whereDate('tgl_pembayaran', $this->searchTanggalPembayaran);
            })
            ->latest()->paginate(5);

        return view('livewire.pages.tata-usaha.pembayaran.riwayat-pembayaran.riwayat-pembayaran', compact('transaksis'));
    }
}
