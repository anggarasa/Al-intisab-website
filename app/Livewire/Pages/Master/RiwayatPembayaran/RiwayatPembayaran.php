<?php

namespace App\Livewire\Pages\Master\RiwayatPembayaran;

use App\Models\Siswa;
use App\Models\TataUsaha\Pembayaran\JenisPembayaran;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use App\Models\TataUsaha\Transaksi;
use Spatie\LaravelPdf\Facades\Pdf;

#[Layout('layouts.master-layout', ['title' => 'Riwayat Pembayaran'])]
class RiwayatPembayaran extends Component
{
    use WithPagination;

    public ?Siswa $selectedSiswa = null;
    public $startDate;
    public $endDate;
    public $search = '';
    public $searchSiswa = '';
    public $jenisPembayarans;

    public function setSelectedSiswa($siswaId)
    {
        $this->jenisPembayarans = JenisPembayaran::all();
        $this->selectedSiswa = Siswa::with(['kelas', 'tagihan.jenisPembayaran'])->find($siswaId);
        $this->searchSiswa = '';
        $this->dispatch('modal-select-siswa');
    }

    public function clearSelectedSiswa()
    {
        $this->selectedSiswa = null;
    }

    public function applyFilter()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function resetFilter()
    {
        $this->startDate = null;
        $this->endDate = null;
        $this->resetPage();
    }

    public function perSiswaPdf()
    {
        $transaksis = collect($this->selectedSiswa->transaksis);
        $pdf = Pdf::view('pdf.riwayat-pembayaran-per-siswa', [
            'transaksis' => $transaksis,
            'siswa' => $this->selectedSiswa,
        ])
            ->format('A4')
            ->name('riwayat-pembayaran-siswa-' . $this->selectedSiswa->name . '-' . now()->timestamp .'.pdf');

        return response()->streamDownload(function () use ($pdf) {
            echo base64_decode($pdf->download()->base64());
        }, $pdf->downloadName);
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
        // Jika ada siswa yang dipilih, gunakan data dari $selectedSiswa->transaksis
        if ($this->selectedSiswa) {
            $transaksis = collect($this->selectedSiswa->transaksis); // Konversi ke Collection untuk kompatibilitas dengan pagination
        } else {
            // Jika tidak ada siswa yang dipilih, jalankan query seperti biasa
            $query = Transaksi::with(['siswa.kelas', 'tagihan.jenisPembayaran'])
                ->when($this->search, function ($query) {
                    $query->whereHas('siswa', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('nisn', 'like', '%' . $this->search . '%');
                    });
                });

            // Filter berdasarkan rentang tanggal jika diset
            if ($this->startDate && $this->endDate) {
                $start = Carbon::parse($this->startDate)->toDateString();
                $end = Carbon::parse($this->endDate)->toDateString();
                $query->whereBetween('tgl_pembayaran', [$start, $end]);
            }

            $transaksis = $query->latest()->paginate(5);
        }

        $siswas = Siswa::with('kelas')
        ->when($this->searchSiswa, function ($query) {
            $query->where('name', 'like', '%' . $this->searchSiswa . '%')
                  ->orWhere('nisn', 'like', '%' . $this->searchSiswa . '%');
        })->get();

        return view('livewire.pages.master.riwayat-pembayaran.riwayat-pembayaran', [
            'pembayarans' => $transaksis,
            'siswas' => $siswas,
        ]);
    }
}
