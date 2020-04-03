<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    protected $table = 't_petugas';

    protected $fillable = [
        'nip','nama_petugas','email','password','slug','role_id','created_at','updated_at'
    ];

    public function role()
    {
    	return $this->belongsTo(Role::class,'role_id','id');
    }

    public function autentikasi()
    {
    	return $this->hasOne(Autentikasi::class);
    }
}
