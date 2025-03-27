<?php

namespace App\Livewire\Pages\Master\RiwayatPembayaran;

use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use App\Models\TataUsaha\Transaksi;
use App\Models\TataUsaha\Pembayaran\JenisPembayaran;
use Spatie\LaravelPdf\Enums\Format;
use Spatie\LaravelPdf\Facades\Pdf;

#[Layout('layouts.master-layout', ['title' => 'Riwayat Pembayaran'])]
class RiwayatPembayaran extends Component
{
    use WithPagination;

    public function cetakPdfs()
    {
        $transaksis = Transaksi::latest()->get();

        $pdf = Pdf::view('pdf.riwayat-pembayaran-semua-siswa', ['transaksis' => $transaksis])
        ->format(Format::A4)
        ->name('riwayat-pembayaran-semua-siswa-'. now()->timestamp .'.pdf');

        return response()->streamDownload(function () use ($pdf) {
            echo base64_decode($pdf->download()->base64());
        }, $pdf->downloadName);
    }

    public function render()
    {
        return view('livewire.pages.master.riwayat-pembayaran.riwayat-pembayaran', [
            'pembayarans' => Transaksi::with(['siswa.kelas', 'tagihan.jenisPembayaran'])->latest()->paginate(5),
        ]);
    }
}
