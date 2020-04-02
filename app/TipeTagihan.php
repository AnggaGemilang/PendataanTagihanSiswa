<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipeTagihan extends Model
{
    protected $table = 't_tipetagihan';

    protected $fillable = [
        'nama_tagihan','nominal','created_at','updated_at'
    ];

    public function tagihan()
    {
    	return $this->hasMany(Tagihan::class);
    }
}
