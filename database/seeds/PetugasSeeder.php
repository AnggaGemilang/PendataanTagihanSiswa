<?php

use Illuminate\Database\Seeder;
use App\Petugas;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PetugasSeeder extends Seeder
{
    public function run()
    {
        Petugas::create([
            'nip' => 102312093213,
            'nama_petugas' => 'admin',
            'email' => 'admin@mail.id',
            'no_telp' => '083195008217',
            'password' => 'admin',
            'role_id' => 2,
            'slug' => Str::slug('admin','-'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
