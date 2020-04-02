<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    protected $table = 't_tagihan';

    protected $fillabel = [
        'id', 'siswa_id', 'tipetagihan_id', 'sudah_dibayar', 'keterangan','created_at','updated_at'
    ];
    public function tipetagihan()
    {
    	return $this->belongsTo(TipeTagihan::class);
    }
    public function siswa()
    {
    	return $this->belongsTo(Siswa::class);
    }
}
