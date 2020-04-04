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
            'nama_petugas' => 'admin',
            'no_telp' => '083195008217',
            'role_id' => 2,
            'slug' => Str::slug('admin','-'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Petugas::create([
            'nama_petugas' => 'petugas',
            'no_telp' => '081232323339',
            'role_id' => 3,
            'slug' => Str::slug('petugas','-'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
