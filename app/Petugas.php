<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Petugas extends Authenticatable
{
    use Notifiable;
    protected $table = 't_petugas';

    protected $fillable = [
        'nip','nama_petugas','email','password','slug','role_id','created_at','updated_at'
    ];

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
