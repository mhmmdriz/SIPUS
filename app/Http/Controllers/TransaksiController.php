<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\Anggota;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\Session;

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

        return view('pengembalian.index', compact('transaksi_selesai', 'transaksi_belum_selesai'));
    }

    public function indexPeminjamanBuku(){
        $buku = Buku::all();
        $anggota = Anggota::where('status', '=', 1)->get();

        $noktp_belum_mengembalikan = Peminjaman::selectRaw("noktp, MAX(tgl_pinjam) AS tgl_pinjam_terbaru")
        ->join("detail_transaksi", "detail_transaksi.idtransaksi", "=", "peminjaman.idtransaksi")
        ->where("tgl_kembali", "=", null)->groupBy("noktp")->pluck("noktp");

        $anggota_belum_meminjam = [];
        $anggota_belum_mengembalikan = [];

        foreach ($anggota as $agt){
            if(in_array($agt->noktp, $noktp_belum_mengembalikan->toArray())){
                $anggota_belum_mengembalikan [] = $agt;
            }else{
                $anggota_belum_meminjam[] = $agt;
            }
        }

        return view("peminjaman.index", [
            "buku"=> $buku,
            "anggota_belum_meminjam" => $anggota_belum_meminjam,
            "anggota_belum_mengembalikan" => $anggota_belum_mengembalikan
        ]);

    }

    public function storePeminjamanBuku(Request $request){
        // dd($request->idbuku);
        $validatedData = $request->validate([
            'noktp' => 'required',
            'idbuku' => [
                'required',
                'array',
                function ($attribute, $value, $fail) {
                    if (count($value) < 1 || count($value) > 2) {
                        $fail('The ' . $attribute . ' must contain 1 or 2 items.');
                    }
                },
            ],
        ]);

        $tabelPeminjaman = [];
        $tabelPeminjaman["noktp"] = $validatedData["noktp"];
        $tabelPeminjaman["tgl_pinjam"] = now()->format("Y-m-d");
        $tabelPeminjaman["idpetugas"] = auth()->user()->petugas->idpetugas;

        Peminjaman::create( $tabelPeminjaman );

        $idBaru =  Peminjaman::select('idtransaksi')->orderBy('idtransaksi', 'desc')->first();;

        $idbuku = $validatedData["idbuku"];
        foreach($idbuku as $id){
            $detailTransaksi = new DetailTransaksi();
            $detailTransaksi->idtransaksi = $idBaru->idtransaksi;
            $detailTransaksi->idbuku = $id;
            $detailTransaksi->denda = 0;
            $detailTransaksi->idpetugas = auth()->user()->petugas->idpetugas;
            $detailTransaksi->save();
        }

        return redirect("/peminjaman")->with("success", "Peminjaman berhasil ditambahkan.");
    }

    public function pengembalianBuku(Request $request)
    {
        $idtransaksi = $request->input('idtransaksi');
        $idbuku = $request->input('idbuku');

        // Query untuk mendapatkan data peminjaman
        $peminjaman = Peminjaman::find($idtransaksi);

        // Perbarui kolom tgl_kembali dengan tanggal saat tombol "Terima Pengembalian" ditekan
        $tgl_kembali = now()->format('Y-m-d');
        $denda = $this->hitungDenda($tgl_kembali, $peminjaman->tgl_pinjam);

        // Perbarui kolom denda di setiap detail_transaksi sesuai dengan denda yang dihitung
        DetailTransaksi::where("idtransaksi", $idtransaksi)->where("idbuku", $idbuku)->update([
            "tgl_kembali" => $tgl_kembali,
            "denda" => $denda,
            "idpetugas" => auth()->user()->petugas->idpetugas
        ]);

        // Menggunakan Session untuk menyimpan pesan sukses
        Session::flash('success', 'Buku telah dikembalikan. Total denda yang harus dibayar: Rp ' . number_format($denda, 0, ",", "."));

        return redirect('/pengembalian');
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
        $idbuku = $request->input('idbuku');

        // Query untuk mendapatkan data peminjaman
        $peminjaman = Peminjaman::find($idtransaksi);

        // Perbarui kolom tgl_kembali dengan tanggal saat tombol "Terima Pengembalian" ditekan
        $tgl_kembali = null;
        $denda = 0;

        // Perbarui kolom denda di setiap detail_transaksi sesuai dengan denda yang dihitung
        DetailTransaksi::where("idtransaksi", $idtransaksi)->where("idbuku", $idbuku)->update([
            "tgl_kembali" => $tgl_kembali,
            "denda" => $denda,
            "idpetugas" => $peminjaman->idpetugas
        ]);

        // Menggunakan Session untuk menyimpan pesan sukses
        Session::flash('success', 'Pengembalian berhasil dibatalkan.');

        return redirect('/pengembalian');
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
           $row['id_petugas'] = $t->idpetugas;

            if($t->tgl_kembali == null){
                if($t->tgl_kembali == null && now()->diffInDays($t->tgl_pinjam) > 14){
                    $extraDenda = now()->diffInDays($t->tgl_pinjam) - 14;
                    $denda = $extraDenda * 1000;
                    $row['denda'] = $denda;
                    $transaksi_belum_selesai_denda [] = (object) $row;
                }else{
                    $transaksi_belum_selesai [] = (object) $row;
                }
            }else{
                $transaksi_selesai [] = (object) $row;
            }
        }
        return view('riwayat_transaksi.index', compact('transaksi_selesai', 'transaksi_belum_selesai', 'transaksi_belum_selesai_denda'));
    }
}
    
