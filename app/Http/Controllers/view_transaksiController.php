<?php

namespace App\Http\Controllers;
// use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\DetailTransaksi;

class view_transaksiController extends Controller
{
    public function index()
    {
        // Ambil data peminjaman dan detail transaksi
        $peminjaman = Peminjaman::all();
        $detailTransaksi = DetailTransaksi::all();

        return view('view_transaksi.index', compact('peminjaman', 'detailTransaksi'));
    }

    // private function kategorikan($peminjaman_trans){
    //   $tgl_pinjam = Peminjaman::select('tgl_pinjam')->get();
    //   $tgl_kembali = DetailTransaksi::select('tgl_kembali')->get();
    //   if ($tgl_kembali){
    //       return $Transaksi->
    //    }
    
    // }

}
?>