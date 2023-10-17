<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $table = "kategori";
    public $timestamps = false;

    protected $primaryKey = 'idkategori';
    protected $guarded = [];

    public function buku()
    {
        return $this->hasMany(Buku::class);
    }

    public function getRouteKeyName()
    {
        return 'idkategori';
    }
}
