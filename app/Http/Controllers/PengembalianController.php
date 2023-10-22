<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\Session;

class PengembalianController extends Controller
{
    public function index()
    {
        // Ambil data peminjaman dan detail transaksi
        $peminjaman = Peminjaman::all();
        $detailTransaksi = DetailTransaksi::all();

        return view('pengembalian.index', compact('peminjaman', 'detailTransaksi'));
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
                $tgl_kembali = $detailTransaksi->tgl_kembali;
                $denda = $this->hitungDenda($tgl_kembali, $tgl_pinjam);

                // Perbarui kolom denda di setiap detail_transaksi sesuai dengan denda yang dihitung
                $detailTransaksi->denda = $denda;
                $detailTransaksi->save();

                $totalDenda += $denda;
            }

            // Menggunakan Session untuk menyimpan pesan sukses
            Session::flash('success', 'Buku telah dikembalikan. Total denda yang harus dibayar: Rp ' . number_format($totalDenda, 0, ",", "."));

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
}
