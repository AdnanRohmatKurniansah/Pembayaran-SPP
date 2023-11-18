<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Authenticatable
{
    use HasFactory;
    protected $guarded = ['id'];
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }
    public function tagihans()
    {
        return $this->hasMany(Tagihan::class);
    }
}
