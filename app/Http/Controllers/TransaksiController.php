<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\Session; // Tambahkan use statement untuk Session

class TransaksiController extends Controller
{
    public function index()
    {
        // Ambil data peminjaman dan detail transaksi
        $transaksi = Peminjaman::join('detail_transaksi', 'detail_transaksi.idtransaksi', '=', 'peminjaman.idtransaksi')
        ->get();

        $transaksi_selesai = [];
        $transaksi_belum_selesai = [];

        foreach ($transaksi as $t) {
            $row = [];
            $row['idtransaksi'] = $t->idtransaksi;
            $row['noktp'] = $t->noktp;
            $row['idbuku'] = $t->idbuku;
            $row['tgl_pinjam'] = $t->tgl_pinjam;
            $row['tgl_kembali'] = $t->tgl_kembali;
            $row['denda'] = $t->denda;
            $row['id_petugas'] = $t->id_petugas;

            if($t->tgl_kembali == null){
                $transaksi_belum_selesai [] = (object) $row;
            }else{
                $transaksi_selesai [] = (object) $row;
            }
        }
        // dump($transaksi_belum_selesai);
        // dd($transaksi_selesai);
        return view('pengembalian.index', compact('transaksi_selesai', 'transaksi_belum_selesai'));
    }

    public function pengembalianBuku(Request $request)
    {
        $idtransaksi = $request->input('idtransaksi');

        // Query untuk mendapatkan data peminjaman
        $peminjaman = Peminjaman::find($idtransaksi);

        if ($peminjaman) {
            $tgl_pinjam = $peminjaman->tgl_pinjam;

            $totalDenda = 0; // Menyimpan total denda dari semua detail transaksi

            foreach ($peminjaman->detailTransaksi as $detailTransaksi) {
                // Perbarui kolom tgl_kembali dengan tanggal saat tombol "Terima Pengembalian" ditekan
                $dateOnly = now()->format('Y-m-d');
                $detailTransaksi->tgl_kembali = $dateOnly;
                $denda = $this->hitungDenda($detailTransaksi->tgl_kembali, $tgl_pinjam);

                // Perbarui kolom denda di setiap detail_transaksi sesuai dengan denda yang dihitung
                $detailTransaksi->denda = $denda;
                $detailTransaksi->save();

                $totalDenda += $denda;
            }

            // Menggunakan Session untuk menyimpan pesan sukses
            Session::flash('success', 'Buku telah dikembalikan. Total denda yang harus dibayar: Rp ' . number_format($totalDenda, 0, ",", "."));

            // Hapus data yang sudah dikembalikan dari daftar peminjaman
            $peminjaman->detailTransaksi->each(function ($detailTransaksi) {
                $detailTransaksi->tgl_kembali;
                $detailTransaksi->denda;
                $detailTransaksi->save();
            });

            return redirect('/pengembalian');
        } else {
            // Menggunakan Session untuk menyimpan pesan kesalahan
            Session::flash('error', 'Data transaksi tidak ditemukan.');

            return redirect('/pengembalian');
        }
    }

    // Fungsi untuk menghitung denda
    private function hitungDenda($tgl_kembali, $tgl_pinjam)
    {
        $selisih_hari = (abs(strtotime($tgl_kembali) - strtotime($tgl_pinjam)) / (60 * 60 * 24));
        $denda = 0;

        if ($selisih_hari > 14) {
            $denda = round(($selisih_hari - 14) * 1000); // Denda dimulai dari hari ke-15
        } else {
            $denda = 0; // Tidak ada denda untuk 14 hari pertama
        }
        return $denda;
    }

    public function batalPengembalian(Request $request)
    {
        $idtransaksi = $request->input('idtransaksi');

        // Query untuk mendapatkan data peminjaman yang sudah dikembalikan
        $peminjaman = Peminjaman::find($idtransaksi);

        if ($peminjaman) {
            $tgl_kembali = $peminjaman->detailTransaksi->first()->tgl_kembali;

            // Perbarui kolom tgl_kembali menjadi NULL dan denda menjadi 0
            $peminjaman->detailTransaksi->each(function ($detailTransaksi) {
                $detailTransaksi->tgl_kembali = null;
                $detailTransaksi->denda = 0;
                $detailTransaksi->save();
            });

            // Menggunakan Session untuk menyimpan pesan sukses
            Session::flash('success', 'Pengembalian berhasil dibatalkan.');

            return redirect('/pengembalian');
        } else {
            // Menggunakan Session untuk menyimpan pesan kesalahan
            Session::flash('error', 'Data transaksi tidak ditemukan.');

            return redirect('/pengembalian');
        }
    }

    public function riwayatTransaksi()
    {
       // Ambil data peminjaman dan detail transaksi
       $transaksi = Peminjaman::join('detail_transaksi', 'detail_transaksi.idtransaksi', '=', 'peminjaman.idtransaksi')
       ->get();

       $transaksi_selesai = [];
       $transaksi_belum_selesai = [];
       $transaksi_belum_selesai_denda = [];

       foreach ($transaksi as $t) {
           $row = [];
           $row['idtransaksi'] = $t->idtransaksi;
           $row['noktp'] = $t->noktp;
           $row['idbuku'] = $t->idbuku;
           $row['tgl_pinjam'] = $t->tgl_pinjam;
           $row['tgl_kembali'] = $t->tgl_kembali;
           $row['denda'] = $t->denda;
           $row['id_petugas'] = $t->id_petugas;

           if($t->tgl_kembali == null){
               $transaksi_belum_selesai [] = (object) $row;
           }else if($t->tgl_kembali == null && now()->diffInDays($t->tgl_pinjam) > 14){
               $extraDenda = now()->diffInDays($t->tgl_pinjam) - 14;
               $denda = $extraDenda * 1000;
               $row['denda'] = $denda;
               $transaksi_belum_selesai_denda [] = (object) $row;
           }else{
                $transaksi_selesai [] = (object) $row;
           }
           
       // dump($transaksi_belum_selesai);
       // dd($transaksi_selesai);
       return view('riwayat_transaksi.index', compact('transaksi_selesai', 'transaksi_belum_selesai', 'transaksi_belum_selesai_denda'));
        }
    }
}
    
