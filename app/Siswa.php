<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Authenticatable
{
    use Notifiable;

    protected $table = 't_siswa';

    protected $fillable = [
        'nis','nisn','nama_siswa','slug','alamat','no_telp','kelas_id','email','password','role_id','created_at','updated_at'
    ];

    public function class()
    {
    	return $this->belongsTo(Kelas::class,'kelas_id','id');
    }

    public function role()
    {
    	return $this->belongsTo(Role::class,'role_id','id');
    }

    protected $hidden = [
        'password', 'remember_token',
    ];


    public function getAuthPassword()
    {
      return $this->password;
    }
}
