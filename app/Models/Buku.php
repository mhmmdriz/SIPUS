<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    protected $table = "buku";
    public $timestamps = false;

    protected $primaryKey = 'idbuku';
    // protected $keyType = 'string';
    public $incrementing = false;

    protected $guarded = [];

    public function kategori(){
        return $this->belongsTo(Kategori::class, 'idkategori', 'idkategori');
    }

    public function getRouteKeyName()
    {
        return 'isbn';
    }
}
