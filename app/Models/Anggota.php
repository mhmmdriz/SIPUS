<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;
    protected $table = "anggota";
    public $timestamps = false;

    protected $primaryKey = 'noktp';
    public $incrementing = false;

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'noktp';
    }
}
