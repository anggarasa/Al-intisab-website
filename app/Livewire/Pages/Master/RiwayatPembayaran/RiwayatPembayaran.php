<?php

namespace App\Livewire\Pages\Master\RiwayatPembayaran;

use App\Models\Siswa;
use App\Models\TataUsaha\Pembayaran\JenisPembayaran;
use App\Models\TataUsaha\Transaksi;
use Illuminate\Support\Facades\Response;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Spatie\LaravelPdf\Enums\Format;
use Spatie\LaravelPdf\Facades\Pdf;

#[Layout('layouts.master-layout', ['title' => 'Riwayat Pembayaran'])]
class RiwayatPembayaran extends Component
{
    use WithPagination;

    public ?Siswa $selectedSiswa = null;    
    public $searchSiswa = '';
    public $searchJenisPembayaran = '';  // Filter berdasarkan jenis pembayaran
    public $searchStatus = '';  // Filter berdasarkan status pembayaran

    public function setSiswa($siswaId)
    {
        $this->selectedSiswa = Siswa::find($siswaId);

        $this->dispatch('modal-search-siswa');
    }
    
    public function resetSearhSiswa()
    {
        $this->searchSiswa = '';
    }

    public function cetakPdfAll()
    {
        try {
            $downloadPath = getenv('USERPROFILE') . '\Downloads\riwayat-pembayaran-' . $this->selectedSiswa->name . '-' . date('Y-m-d-H-i-s') . '.pdf';

            // Pastikan direktori ada sebelum menyimpan file
            if (!file_exists(dirname($downloadPath))) {
                mkdir(dirname($downloadPath), 0755, true);
            }

            // Generate PDF dan simpan ke Downloads
            Pdf::view('pdfs.riwayat-pembayaran-siswa-all', ['siswa' => $this->selectedSiswa])
                ->format(Format::A4)
                ->save($downloadPath);

            $this->dispatch('notificationMaster', [
                'type' => 'success',
                'message' => 'PDF berhasil di unduh',
                'title' => 'Berhasil'
            ]);
        } catch (\Exception $e) {
            $this->dispatch('notificationMaster', [
                'type' => 'error',
                'message' => 'PDF gagal di unduh',
                'title' => 'Gagal'
            ]);
        }
    }
    
    public function render()
    {
        $siswas = Siswa::where('name', 'like', '%'. $this->searchSiswa .'%')
                ->orWhere('nisn', 'like', '%'. $this->searchSiswa .'%')->get();

        $jenisPembayarans = null;
        if ($this->selectedSiswa) {
            $jenisPembayarans = $this->selectedSiswa->tagihan()->get();
        }
        
        // Query transaksi hanya jika siswa dipilih
        $transaksis = null;
        if ($this->selectedSiswa) {
            $transaksis = $this->selectedSiswa->transaksis()->latest();

            // Filter berdasarkan jenis pembayaran
            if (!empty($this->searchJenisPembayaran)) {
                $transaksis->whereHas('tagihan.jenisPembayaran', function ($query) {
                    $query->where('id', $this->searchJenisPembayaran);
                });
            }

            // Ambil data transaksi dengan pagination
            $transaksis = tap($transaksis->paginate(5), function ($paginated) {
                $paginated->getCollection()->transform(function ($transaksi) {
                    $transaksi->status = $transaksi->tagihan->sisa_tagihan == 0 ? 'Lunas' : 'Belum Lunas';
                    return $transaksi;
                });
            });

            // Filter berdasarkan status pembayaran setelah pagination
            if (!empty($this->searchStatus)) {
                $transaksis->setCollection(
                    $transaksis->getCollection()->filter(function ($transaksi) {
                        return $transaksi->status === $this->searchStatus;
                    })
                );
            }
        }

        $totalLunas = Siswa::whereHas('tagihan', function ($query) {
            $query->where('sisa_tagihan', 0);
        })->count();

        $totalSiswa = Siswa::count();
             
        return view('livewire.pages.master.riwayat-pembayaran.riwayat-pembayaran', [
            'siswas' => $siswas,
            'jenisPembayarans' => $jenisPembayarans,
            'transaksis' => $transaksis,
            'totalSiswa' => $totalSiswa,
            'totalLunas' => $totalLunas,
        ]);
    }
}
