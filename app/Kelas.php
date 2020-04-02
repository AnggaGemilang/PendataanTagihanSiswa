<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 't_kelas';

    protected $fillabel = [
        'id', 'nama', 'slug', 'jurusan','wali_kelas'
    ];

    public function students()
    {
    	return $this->hasMany(Siswa::class);
    }
    public function tipekelas()
    {
    	return $this->belongsTo(TipeKelas::class,'tipekelas_id','id');
    }
}
