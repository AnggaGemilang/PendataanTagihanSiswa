<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 't_role';

    protected $fillable = [
        'nama_role','created_at','updated_at'
    ];

    public function students()
    {
    	return $this->hasMany(Siswa::class);
    }

    public function staffs()
    {
    	return $this->hasMany(Petugas::class);
    }
}
