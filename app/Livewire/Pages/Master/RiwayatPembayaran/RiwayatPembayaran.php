<?php

namespace App\Livewire\Pages\Master\RiwayatPembayaran;

use Carbon\Carbon;
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

    public $startDate;
    public $endDate;

    public function applyFilter()
    {
        $this->resetPage();
    }

    public function resetFilter()
    {
        $this->startDate = null;
        $this->endDate = null;
        $this->resetPage();
    }

    public function cetakPdf()
    {
        $query = Transaksi::query();

        if ($this->startDate && $this->endDate) {
            $start = Carbon::parse($this->startDate)->toDateString();
            $end = Carbon::parse($this->endDate)->toDateString();

            $query->whereBetween('tgl_pembayaran', [$start, $end]);
        }

        $transaksis = $query->latest()->get();

        $pdf = Pdf::view('pdf.riwayat-pembayaran-semua-siswa', [
            'transaksis' => $transaksis,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate
        ])
            ->format('A4')
            ->name('riwayat-pembayaran-'. now()->timestamp .'.pdf');

        return response()->streamDownload(function () use ($pdf) {
            echo base64_decode($pdf->download()->base64());
        }, $pdf->downloadName);
    }

    public function render()
    {
        $query = Transaksi::with(['siswa.kelas', 'tagihan.jenisPembayaran']);

        // Filter berdasarkan rentang tanggal jika diset
        if ($this->startDate && $this->endDate) {
            $start = Carbon::parse($this->startDate)->toDateString();
            $end = Carbon::parse($this->endDate)->toDateString();

            $query->whereBetween('tgl_pembayaran', [$start, $end]);
        }

        return view('livewire.pages.master.riwayat-pembayaran.riwayat-pembayaran', [
            'pembayarans' => $query->latest()->paginate(5),
        ]);
    }
}
