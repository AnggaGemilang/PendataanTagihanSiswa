<?php

use Illuminate\Database\Seeder;
use App\Autentikasi;
use Carbon\Carbon;

class AutentikasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Autentikasi::create([
            'nomor_induk' => 1718117111,
            'email' => 'angga@mail.id',
            'password' => Hash::make('123456789'),
            'role_id' => 1,
            'siswa_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Autentikasi::create([
            'nomor_induk' => 102312093213,
            'email' => 'admin@mail.id',
            'password' => Hash::make('123456789'),
            'role_id' => 2,
            'petugas_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Autentikasi::create([
            'nomor_induk' => 686785685686,
            'email' => 'petugas@mail.id',
            'password' => Hash::make('123456789'),
            'role_id' => 3,
            'petugas_id' => 2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
