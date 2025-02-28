<?php

namespace App\Livewire\Pages\Master\RiwayatPembayaran;

use App\Models\TataUsaha\Transaksi;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.master-layout', ['title' => 'Riwayat Pembayaran'])]
class RiwayatPembayaran extends Component
{
    public function render()
    {
        $transaksis = Transaksi::with(['siswa', 'tagihan', 'tagihan.jenisPembayaran'])
                        ->latest()->paginate(5);
        
        return view('livewire.pages.master.riwayat-pembayaran.riwayat-pembayaran', compact('transaksis'));
    }
}
