<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }
    public function spp()
    {
        return $this->belongsTo(Spp::class, 'id_spp');
    }
    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class);
    }
}
