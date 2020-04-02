<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipeKelas extends Model
{
    protected $table = 't_tipekelas';

    protected $fillable = [
        'nama_tipekelas','created_at','updated_at'
    ];

    public function kelas()
    {
    	return $this->hasMany(Kelas::class);
    }
}
