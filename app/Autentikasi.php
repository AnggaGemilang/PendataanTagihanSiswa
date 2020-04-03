<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Autentikasi extends Authenticatable
{
    use Notifiable;

    protected $table = 't_autentikasi';

    protected $fillable = [
        'email','password','role_id','angga_id','petugas_id','created_at','updated_at'
    ];

    public function siswa()
    {
    	return $this->belongsTo(Siswa::class,'siswa_id','id');
    }

    public function petugas()
    {
    	return $this->belongsTo(Petugas::class,'petugas_id','id');
    }

    protected $hidden = [
        'password', 'remember_token',
    ];
}
