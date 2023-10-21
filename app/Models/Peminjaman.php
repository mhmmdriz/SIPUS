<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';
    protected $primaryKey = 'idtransaksi';
    protected $fillable = ['noktp', 'tgl_pinjam', 'tgl_kembali'];

    // Definisikan relasi dengan model DetailTransaksi
    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'idtransaksi', 'idtransaksi');
    }
}
