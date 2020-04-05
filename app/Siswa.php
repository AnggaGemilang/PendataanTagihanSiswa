<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 't_siswa';

    protected $fillable = [
        'nis','nisn','nama_siswa','slug','alamat','no_telp','kelas_id','email','password','role_id','created_at','updated_at'
    ];

    public function pembayaran()
    {
    	return $this->hasMany(Pembayaran::class);
    }

    public function class()
    {
    	return $this->belongsTo(Kelas::class,'kelas_id','id');
    }

    public function autentikasi()
    {
    	return $this->hasOne(Autentikasi::class);
    }

    public function role()
    {
    	return $this->belongsTo(Role::class,'role_id','id');
    }
}
