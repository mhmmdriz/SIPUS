<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';
    protected $primaryKey = 'idtransaksi';
    protected $guarded = [];
    public $timestamps = false;
    public $incrementing = false;
    // Definisikan relasi dengan model DetailTransaksi
    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'idtransaksi', 'idtransaksi');
    }
    public function getRouteKeyName(): string
    {
        return 'idtransaksi';
    }
}
