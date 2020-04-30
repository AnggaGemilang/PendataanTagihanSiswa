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
            'nomor_induk' => 1920117111,
            'email' => 'david@mail.id',
            'password' => Hash::make('1920117111'),
            'role_id' => 1,
            'siswa_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Autentikasi::create([
            'nomor_induk' => 1819117111,
            'email' => 'steven@mail.id',
            'password' => Hash::make('1819117111'),
            'role_id' => 1,
            'siswa_id' => 2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Autentikasi::create([
            'nomor_induk' => 1718117111,
            'email' => 'angga@mail.id',
            'password' => Hash::make('1718117111'),
            'role_id' => 1,
            'siswa_id' => 3,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Autentikasi::create([
            'nomor_induk' => 12345678910,
            'email' => 'kusmoro@mail.id',
            'password' => Hash::make('12345678910'),
            'role_id' => 2,
            'petugas_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        Autentikasi::create([
            'nomor_induk' => 1112131415,
            'email' => 'nana@mail.id',
            'password' => Hash::make('1112131415'),
            'role_id' => 3,
            'petugas_id' => 2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
