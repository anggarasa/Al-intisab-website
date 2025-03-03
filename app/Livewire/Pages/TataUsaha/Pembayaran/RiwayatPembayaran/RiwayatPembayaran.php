<?php

namespace App\Livewire\Pages\TataUsaha\Pembayaran\RiwayatPembayaran;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\TataUsaha\Transaksi;

#[Layout('layouts.tatausaha-layout', ['title' => 'Riwayat Pembayaran'])]
class RiwayatPembayaran extends Component
{
    public function render()
    {
        $transaksis = Transaksi::with(['siswa', 'tagihan', 'tagihan.jenisPembayaran'])
                        ->latest()->paginate(5);

        return view('livewire.pages.tata-usaha.pembayaran.riwayat-pembayaran.riwayat-pembayaran', compact('transaksis'));
    }
}
