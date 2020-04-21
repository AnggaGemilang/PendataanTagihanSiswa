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
            'nama_petugas' => 'Kusmoro Rusli',
            'no_telp' => '083173002217',
            'role_id' => 2,
            'slug' => Str::slug('admin','-'),
            'profil' => 'admin-profil.png',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Petugas::create([
            'nama_petugas' => 'Nana Suryana',
            'no_telp' => '081232323339',
            'role_id' => 3,
            'slug' => Str::slug('petugas','-'),
            'profil' => 'petugas-profil.png',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
