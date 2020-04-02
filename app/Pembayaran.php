<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 't_pembayaran';

    protected $fillabel = [
        'nominal', 'siswa_id','petugas_id','tagihan_id','kelas_id'
    ];

    public function tagihan()
    {
    	return $this->belongsTo(Tagihan::class,'tagihan_id','id');
    }
    public function kelas()
    {
    	return $this->belongsTo(Kelas::class,'kelas_id','id');
    }
    public function petugas()
    {
    	return $this->belongsTo(Petugas::class,'petugas_id','id');
    }
}
