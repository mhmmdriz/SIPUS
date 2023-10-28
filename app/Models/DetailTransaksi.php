<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    protected $table = 'detail_transaksi';
    protected $primaryKey = 'idtransaksi';
    protected $fillable = ['idtransaksi', 'idbuku', 'tgl_kembali', 'denda'];
    public $timestamps = false;

    // Definisikan relasi dengan model Peminjaman
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'idtransaksi', 'idtransaksi');
    }
    public function buku()
    {
        return $this->belongsTo(Buku::class, 'idbuku', 'idbuku');
    }
}
