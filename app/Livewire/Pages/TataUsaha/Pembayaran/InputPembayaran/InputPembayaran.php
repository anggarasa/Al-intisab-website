<?php

namespace App\Livewire\Pages\TataUsaha\Pembayaran\InputPembayaran;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Jurusan;
use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\TataUsaha\Transaksi;
use App\Models\TataUsaha\Pembayaran\Tagihan;
use App\Models\TataUsaha\Pembayaran\JenisPembayaran;

#[Layout('layouts.tatausaha-layout', ['title' => 'Input Pembayaran'])]
class InputPembayaran extends Component
{
    public $searchJurusan = '';
    public $searchKelas = '';
    public $searchSiswa = '';
    public $jurusans;
    public $kelases = [];
    public $siswa = null;
    public $jumlahPembayaran;
    public $jenisPembayaran;
    public $tglPembayaran;
    public $keterangan;

    public function mount()
    {
        $this->jurusans = Jurusan::all();
    }

    public function updatedSearchJurusan($jurusanId)
    {
        $this->kelases = Kelas::where('jurusan_id', $jurusanId)->get();
        $this->searchKelas = '';
        $this->searchSiswa = '';
        $this->siswa = null;
    }

    public function search()
    {
        $query = Siswa::query();

        if (!empty($this->searchSiswa)) {
            $query->where('nisn', 'like', '%' . $this->searchSiswa . '%')
                ->orWhere('name', 'like', '%' . $this->searchSiswa . '%');
        } else {
            if (!empty($this->searchJurusan)) {
                $query->whereHas('kelas', function ($q) {
                    $q->where('jurusan_id', $this->searchJurusan);
                });
            }
            if (!empty($this->searchKelas)) {
                $query->where('kelas_id', $this->searchKelas);
            }
        }

        $this->siswa = $query->first();
    }
    
    // input pembayaran
    public function inputPembayaran()
    {
        if (!$this->siswa) {
            $this->dispatch('notificationTataUsaha', [
                'type' => 'error',
                'message' => 'Silakan pilih siswa terlebih dahulu.',
                'title' => 'Gagal',
            ]);
            return;
        }

        try {
            $this->validate([
                'jenisPembayaran' => ['required', 'exists:tagihans,id'], // Pastikan jenisPembayaran ada di tabel tagihan
                'jumlahPembayaran' => ['required', 'numeric'],
                'tglPembayaran' => ['required', 'date'],
                'keterangan' => ['nullable'],
            ]);

            $jenisTagihan = Tagihan::findOrFail($this->jenisPembayaran);

            // hitung total pembayaran
            $totalPembayaran = $jenisTagihan->sisa_tagihan - $this->jumlahPembayaran;

            // simpan transaksi
            Transaksi::create([
                'siswa_id' => $this->siswa->id,
                'tagihan_id' => $this->jenisPembayaran,
                'jumlah_pembayaran' => $this->jumlahPembayaran,
                'sisa_tagihan' => $totalPembayaran,
                'tgl_pembayaran' => $this->tglPembayaran,
                'keterangan' => $this->keterangan,
            ]);

            // update tagihan siswa
            $jenisTagihan->update([
                'sisa_tagihan' => $totalPembayaran,
            ]);

            // kirim notifikasi success
            $this->dispatch('notificationTataUsaha', [
                'type' => 'success',
                'message' => $this->siswa->name .' Berhasil melakukan pembayaran '. $jenisTagihan->JenisPembayaran->nama_pembayaran,
                'title' => 'Berhasil',
            ]);
        } catch (\Exception $e) {
            // kirim notifikasi error
            $this->dispatch('notificationTataUsaha', [
                'type' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Gagal',
            ]);
        }
    }
    // End input pembayaran
    
    public function render()
    {
        return view('livewire.pages.tata-usaha.pembayaran.input-pembayaran.input-pembayaran', [
            'kelases' => $this->kelases,
            'jenisPembayarans' => JenisPembayaran::all(),
        ]);
    }

    // message error custom
    protected $messages = [
        'jenisPembayaran.required' => 'Jenis pembayaran harus diisi.',
        'jumlahPembayaran.required' => 'Jumlah pembayaran harus diisi.',
        'jumlahPembayaran.numeric' => 'Jumlah pembayaran harus berupa angka.',
        'tglPembayaran.required' => 'Tanggal pembayaran harus diisi.',
        'tglPembayaran.date' => 'Tanggal pembayaran harus berupa tanggal.',
    ];
}
