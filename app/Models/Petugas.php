<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    use HasFactory;
    protected $table = 'petugas';
    protected $primaryKey = 'email';
    public $timestamps = false;
    public $incrementing = false;

    public function user()
    {
        return $this->hasOne(User::class, 'email', 'email');
    }
}
